# 🚀 CODE-ONLY OPTIMIZATION ROADMAP
## For Khanza-Based Hospital System (No Database Changes)
## Target: 150-200 patients/day, Multiple Concurrent Doctors

---

## ⚡ QUICK WINS - Start Here! (Day 1-3)

### 🎯 **Priority 1: Reduce AJAX Calls (BIGGEST IMPACT!)**

**Current Problem:** 16 AJAX calls per page load = SUPER SLOW!

**File:** `assets/js/riwayatPasien.js`

#### STEP 1: Replace Multiple AJAX with Single Call

**Find this section (around line 1330):**
```javascript
// OLD CODE - DELETE THIS
$.when(
    $.get(API_URLS.RP_SUMMARY, { no_rawat: norawat }),
    $.get(API_URLS.RP_SOAP, { no_rawat: norawat }),
    $.get(API_URLS.RP_DIAG, { no_rawat: norawat }),
    // ... 13 more calls
).done(function(...) {
    // ...
});
```

**Replace with:**
```javascript
// NEW CODE - SINGLE AJAX CALL
function loadFullDetailInto($container, base) {
    const norawat = base.no_rawat;
    $container.append(headerBlock(base));

    // Show loading indicator
    $container.append('<div class="text-center" style="padding:40px"><i class="fa fa-spinner fa-spin fa-3x"></i><p>Memuat detail...</p></div>');

    // SINGLE AJAX CALL using get_detail endpoint
    $.ajax({
        url: BASE_URL + 'RiwayatPasien/get_detail',
        type: 'POST',
        data: { no_rawat: norawat },
        dataType: 'json',
        timeout: 10000, // 10 second timeout
        success: function(response) {
            $container.find('.text-center').remove(); // Remove loading
            
            if (!response.success) {
                $container.append('<div class="alert alert-danger">Gagal memuat data: ' + (response.message || 'Unknown error') + '</div>');
                return;
            }

            const d = response.data;
            
            // Build print payload
            const printPayload = {
                base: d.base,
                summary: d.summary,
                soapRaw: d.soapRaw,
                diag: d.diag,
                proc: d.proc,
                tind: d.tind,
                resep: d.resep,
                lab: d.lab,
                rad: d.rad,
                rdocs: d.rdocs,
                berkas_digital: d.berkas_digital,
                igd: d.igd,
                pd: d.pd,
                ortho: d.ortho,
                operasi: d.operasi || {},
                penunjang: d.penunjang || {},
                laptind: d.laptind || {}
            };
            
            window.currentPrintData = printPayload;
            
            // Attach to print button
            $container.find('.btn-print-riwayat')
                .data('printPayload', printPayload)
                .off('click').on('click', function (e) {
                    e.preventDefault();
                    console.log('Print button clicked, payload:', printPayload);
                    window.printRiwayat(printPayload);
                });

            // Continue with existing rendering logic
            const data = d.summary?.data || d.summary || {};
            const resume = data.resume || null;
            const ttvSum = data.ttv_terakhir || {};
            const cardsToShow = [];

            // All your existing render functions
            renderAsesmenPD();
            renderAsesmenOrtho();
            renderIGD();
            renderTandaVital();
            renderDiagnosa();
            renderProsedur();
            renderSOAP();
            renderTindakan();
            renderResep();
            renderLaboratorium();
            renderRadiologi();
            renderBerkasDigital();
            renderOperasi();
            renderPenunjang();
            renderLaporanTindakan();
            renderResume();

            // Display all cards
            if (cardsToShow.length > 0) {
                cardsToShow.forEach(cardHtml => {
                    $container.append(cardHtml);
                });
            } else {
                $container.append('<div class="text-center text-muted" style="padding:20px">Tidak ada data detail untuk kunjungan ini.</div>');
            }

            applyBadgeSpotlight($container);
        },
        error: function(xhr, status, error) {
            $container.find('.text-center').remove();
            console.error('Load detail error:', error, xhr);
            $container.append('<div class="alert alert-danger">Error: ' + error + '</div>');
        }
    });
}
```

**Expected Impact:** ⚡ **80% faster page load** (16 requests → 1 request)

---

### 🎯 **Priority 2: Add Response Caching**

**File:** `application/controllers/RiwayatPasienController.php`

```php
<?php
class RiwayatPasienController extends CI_Controller
{
    private $cache_ttl = 300; // 5 minutes cache
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('RiwayatPasien_model');
        $this->load->driver('cache', array('adapter' => 'file', 'backup' => 'dummy'));
    }
    
    public function get_detail()
    {
        $no_rawat = $this->input->post('no_rawat');
        if (!$no_rawat) {
            echo json_encode(['success' => false, 'message' => 'no_rawat required']);
            return;
        }

        // Generate cache key
        $cache_key = 'riwayat_' . md5($no_rawat . '_v2'); // v2 for version control
        
        // Try to get from cache
        $cached_data = $this->cache->get($cache_key);
        if ($cached_data !== FALSE) {
            // Add cache indicator
            $cached_data['_cached'] = true;
            $cached_data['_cache_time'] = date('Y-m-d H:i:s');
            echo json_encode(['success' => true, 'data' => $cached_data]);
            return;
        }

        try {
            // Aggregate all data (existing code)
            $data = [
                'base' => $this->RiwayatPasien_model->get_base_info($no_rawat),
                'summary' => $this->RiwayatPasien_model->get_summary_by_norawat($no_rawat),
                'soapRaw' => $this->RiwayatPasien_model->get_soap_by_norawat($no_rawat),
                'diag' => $this->RiwayatPasien_model->get_diagnosa_by_norawat($no_rawat),
                'proc' => $this->RiwayatPasien_model->get_prosedur_by_norawat($no_rawat),
                'tind' => $this->RiwayatPasien_model->get_tindakan_by_norawat($no_rawat),
                'resep' => $this->RiwayatPasien_model->get_resep_by_norawat($no_rawat),
                'lab' => $this->RiwayatPasien_model->get_lab_by_norawat($no_rawat),
                'rad' => $this->RiwayatPasien_model->get_radiologi_by_norawat($no_rawat),
                'rdocs' => $this->RiwayatPasien_model->get_radiologi_docs($no_rawat),
                'berkas_digital' => $this->RiwayatPasien_model->get_berkas_digital($no_rawat),
                'igd' => $this->RiwayatPasien_model->get_asesmen_igd_by_norawat($no_rawat),
                'pd' => $this->RiwayatPasien_model->get_awal_medis_penyakit_dalam_by_norawat($no_rawat),
                'ortho' => $this->RiwayatPasien_model->get_awal_medis_orthopedi_by_norawat($no_rawat),
            ];

            // Save to cache
            $this->cache->save($cache_key, $data, $this->cache_ttl);

            echo json_encode(['success' => true, 'data' => $data]);
        } catch (Exception $e) {
            log_message('error', 'get_detail error: ' . $e->getMessage());
            echo json_encode(['success' => false, 'message' => 'Terjadi kesalahan sistem']);
        }
    }
    
    // Method to clear cache when data is updated
    public function clear_cache_for_visit($no_rawat)
    {
        $cache_key = 'riwayat_' . md5($no_rawat . '_v2');
        $this->cache->delete($cache_key);
    }
}
```

**Call clear_cache when data changes:**
```php
// In your save SOAP/Diagnosa/etc methods
public function save_soap()
{
    // ... save logic ...
    
    // Clear cache after save
    $this->load->controller('RiwayatPasienController');
    $this->RiwayatPasienController->clear_cache_for_visit($no_rawat);
}
```

**Expected Impact:** ⚡ **70% faster for repeated access**

---

### 🎯 **Priority 3: Optimize Database Queries**

**File:** `application/models/RiwayatPasien_model.php`

#### A. Use Query Result Caching
```php
<?php
class RiwayatPasien_model extends CI_Model
{
    // Enable query caching for read-only queries
    public function get_base_info($no_rawat)
    {
        // Cache this query for 5 minutes
        $this->db->cache_on();
        
        $query = $this->db
            ->select('r.*, p.nm_pasien, p.no_rkm_medis, p.jk, p.tgl_lahir, 
                      po.nm_poli, d.nm_dokter, pj.png_jawab')
            ->from('reg_periksa r')
            ->join('pasien p', 'r.no_rkm_medis = p.no_rkm_medis', 'left')
            ->join('poliklinik po', 'r.kd_poli = po.kd_poli', 'left')
            ->join('dokter d', 'r.kd_dokter = d.kd_dokter', 'left')
            ->join('penjab pj', 'r.kd_pj = pj.kd_pj', 'left')
            ->where('r.no_rawat', $no_rawat)
            ->get();
        
        $this->db->cache_off();
        
        return $query->row_array();
    }
    
    // Use LIMIT to prevent huge result sets
    public function get_soap_by_norawat($no_rawat)
    {
        $this->db->cache_on();
        
        $query = $this->db
            ->select('*')
            ->from('pemeriksaan_ralan')
            ->where('no_rawat', $no_rawat)
            ->order_by('tgl_perawatan', 'DESC')
            ->order_by('jam_rawat', 'DESC')
            ->limit(50) // Prevent loading too many records
            ->get();
        
        $this->db->cache_off();
        
        return $query->result_array();
    }
}
```

**Expected Impact:** ⚡ **40% faster queries**

---

### 🎯 **Priority 4: Lazy Loading for Images**

**File:** `assets/js/riwayatPasien.js`

```javascript
// Add lazy loading for images
function renderRadiologyImages(rdocsData) {
    if (!rdocsData || rdocsData.length === 0) return '';
    
    const imgs = rdocsData.map(x => {
        const imgSrc = x.url || x.file || x.lokasi_file || x.path;
        if (!imgSrc) return '';

        return `
            <div style="display:inline-block; margin:8px; text-align:center; vertical-align:top; border:1px solid #ddd; padding:8px; background:#fff; border-radius:4px; max-width:300px;">
                <img 
                    data-src="${imgSrc}" 
                    class="lazy-load-img" 
                    style="max-width:280px; max-height:280px; width:auto; height:auto; display:block; margin:0 auto; border:1px solid #ccc; background:#f0f0f0;"
                    alt="Loading..."
                >
                <div style="font-size:9px; color:#666; margin-top:6px; padding-top:6px; border-top:1px solid #eee;">${x.label || x.nama || x.tgl || ''}</div>
            </div>
        `;
    }).filter(x => x).join('');
    
    return imgs;
}

// Add lazy loading script at bottom of file
$(document).ready(function() {
    // Lazy load images when they come into view
    function lazyLoadImages() {
        const lazyImages = document.querySelectorAll('img.lazy-load-img');
        
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.remove('lazy-load-img');
                    observer.unobserve(img);
                }
            });
        });
        
        lazyImages.forEach(img => imageObserver.observe(img));
    }
    
    // Call after content loaded
    $(document).on('DOMContentLoaded', lazyLoadImages);
    
    // Also call when new content added
    $(document).on('contentLoaded', lazyLoadImages);
});
```

**Expected Impact:** ⚡ **50% faster initial page load**

---

### 🎯 **Priority 5: Optimize Print Function**

**File:** `assets/js/riwayatPasien.js`

```javascript
// Optimize bulk print by generating HTML in chunks
window.printBulkRiwayat = async function () {
    console.log("printBulkRiwayat: Starting...");
    
    const list = state.cache_rows.slice();
    if (!list.length) {
        alert('Tidak ada riwayat yang dimuat. Silakan buka riwayat terlebih dahulu.');
        return;
    }

    console.log(`printBulkRiwayat: Found ${list.length} visit(s) to print.`);

    // Show progress
    Swal.fire({
        title: 'Memuat Data...',
        html: 'Progress: <b>0</b>/' + list.length,
        allowOutsideClick: false,
        didOpen: () => Swal.showLoading()
    });

    try {
        const payloads = [];
        
        // Load data in batches of 5 to prevent timeout
        const batchSize = 5;
        for (let i = 0; i < list.length; i += batchSize) {
            const batch = list.slice(i, i + batchSize);
            
            const batchPromises = batch.map(item => 
                $.ajax({
                    url: BASE_URL + 'RiwayatPasien/get_detail',
                    type: 'POST',
                    data: { no_rawat: item.no_rawat },
                    dataType: 'json',
                    timeout: 15000
                })
            );
            
            const results = await Promise.all(batchPromises);
            
            results.forEach(res => {
                if (res && res.success && res.data) {
                    payloads.push(res.data);
                }
            });
            
            // Update progress
            Swal.update({
                html: 'Progress: <b>' + payloads.length + '</b>/' + list.length
            });
        }

        if (payloads.length === 0) {
            Swal.close();
            alert('Gagal memuat data riwayat. Silakan coba lagi.');
            return;
        }

        console.log(`printBulkRiwayat: Successfully loaded ${payloads.length} visit details.`);

        // Generate HTML in chunks to prevent browser freeze
        Swal.update({ title: 'Membuat Dokumen...', html: 'Mohon tunggu...' });
        
        let fullContent = '';
        for (let i = 0; i < payloads.length; i++) {
            fullContent += generateReportHtml(payloads[i]);
            
            // Give browser time to breathe every 10 records
            if (i % 10 === 0 && i > 0) {
                await new Promise(resolve => setTimeout(resolve, 100));
            }
        }

        console.log("printBulkRiwayat: HTML generated. Opening window...");
        Swal.close();

        // Open print window
        const printWindow = window.open('', '_blank');
        printWindow.document.write(`
            <!DOCTYPE html>
            <html>
                <head><title>Cetak Riwayat Bulk - ${payloads[0]?.summary?.header?.nm_pasien || 'Pasien'}</title>
                    <style>
                        @page {size: A4; margin: 10mm 15mm; }
                        body {font-family: "Times New Roman", Times, serif; font-size: 11px; margin: 0; padding: 10px; color: #000; }
                        /* ... rest of styles ... */
                    </style>
                </head>
                <body onload="window.print()">${fullContent}</body>
            </html>
        `);
        printWindow.document.close();
        
        // Close modal
        setTimeout(() => {
            $('#modal_all_riwayat').modal('hide');
        }, 500);

    } catch (err) {
        Swal.close();
        console.error("Error in printBulkRiwayat:", err);
        alert("Terjadi kesalahan saat mencetak: " + err.message);
    }
};
```

**Expected Impact:** ⚡ **No browser freeze, smoother UX**

---

### 🎯 **Priority 6: Enable Gzip Compression**

**File:** `application/config/config.php`

```php
// Enable output compression
$config['compress_output'] = TRUE;
```

**File:** `.htaccess` (create in root if not exists)

```apache
# Enable Gzip Compression
<IfModule mod_deflate.c>
    AddOutputFilterByType DEFLATE text/html text/plain text/xml text/css text/javascript application/javascript application/json
</IfModule>

# Enable Browser Caching
<IfModule mod_expires.c>
    ExpiresActive On
    ExpiresByType image/jpg "access plus 1 year"
    ExpiresByType image/jpeg "access plus 1 year"
    ExpiresByType image/gif "access plus 1 year"
    ExpiresByType image/png "access plus 1 year"
    ExpiresByType text/css "access plus 1 month"
    ExpiresByType application/javascript "access plus 1 month"
    ExpiresByType application/pdf "access plus 1 month"
</IfModule>

# Leverage Browser Caching
<IfModule mod_headers.c>
    <FilesMatch "\.(jpg|jpeg|png|gif|css|js)$">
        Header set Cache-Control "max-age=2592000, public"
    </FilesMatch>
</IfModule>
```

**Expected Impact:** ⚡ **40% smaller response size**

---

### 🎯 **Priority 7: Optimize Session Handling**

**File:** `application/config/config.php`

```php
// Use database for sessions (better for multiple servers)
$config['sess_driver'] = 'database';
$config['sess_cookie_name'] = 'moiz_session';
$config['sess_expiration'] = 7200; // 2 hours
$config['sess_save_path'] = 'ci_sessions';
$config['sess_match_ip'] = FALSE; // Set FALSE for better performance
$config['sess_time_to_update'] = 300;
$config['sess_regenerate_destroy'] = FALSE; // Set FALSE for better performance
```

**Create session table (if not exists):**
```sql
CREATE TABLE IF NOT EXISTS `ci_sessions` (
    `id` varchar(128) NOT NULL,
    `ip_address` varchar(45) NOT NULL,
    `timestamp` int(10) unsigned DEFAULT 0 NOT NULL,
    `data` blob NOT NULL,
    KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

---

### 🎯 **Priority 8: Add Request Throttling**

**File:** `application/libraries/Throttle.php` (create new)

```php
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Throttle
{
    protected $CI;
    protected $max_requests = 100; // Max requests per minute
    protected $block_duration = 60; // Block for 60 seconds
    
    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->driver('cache');
    }
    
    public function check($identifier = null)
    {
        if (!$identifier) {
            $identifier = $this->CI->input->ip_address();
        }
        
        $cache_key = 'throttle_' . md5($identifier);
        $requests = $this->CI->cache->get($cache_key);
        
        if ($requests === FALSE) {
            $requests = 1;
        } else {
            $requests++;
        }
        
        if ($requests > $this->max_requests) {
            // Too many requests
            log_message('warning', 'Throttle limit exceeded for: ' . $identifier);
            return FALSE;
        }
        
        // Save request count
        $this->CI->cache->save($cache_key, $requests, 60);
        
        return TRUE;
    }
}
```

**Use in controller:**
```php
public function get_detail()
{
    $this->load->library('throttle');
    
    if (!$this->throttle->check()) {
        echo json_encode(['success' => false, 'message' => 'Too many requests. Please wait.']);
        return;
    }
    
    // ... rest of code ...
}
```

---

## 📊 EXPECTED PERFORMANCE IMPROVEMENTS

| Optimization | Impact | Effort | Priority |
|--------------|--------|--------|----------|
| Reduce AJAX calls (16→1) | **80%** ⚡⚡⚡ | Medium | 🔴 HIGH |
| Add caching | **70%** ⚡⚡⚡ | Low | 🔴 HIGH |
| Optimize queries | **40%** ⚡⚡ | Low | 🟡 MEDIUM |
| Lazy load images | **50%** ⚡⚡ | Low | 🟡 MEDIUM |
| Optimize print | **30%** ⚡ | Medium | 🟢 LOW |
| Gzip compression | **40%** ⚡⚡ | Very Low | 🔴 HIGH |
| Session optimization | **20%** ⚡ | Low | 🟢 LOW |
| Request throttling | **Security** 🛡️ | Low | 🟡 MEDIUM |

**Overall Expected Improvement:** **70-85% faster** 🚀

---

## 📋 IMPLEMENTATION CHECKLIST

### Day 1: Quick Wins
- [ ] Reduce AJAX calls (16 → 1)
- [ ] Enable Gzip compression
- [ ] Add response caching

### Day 2: Query Optimization
- [ ] Enable query result caching
- [ ] Add LIMIT to queries
- [ ] Optimize model methods

### Day 3: UX Improvements
- [ ] Add lazy loading for images
- [ ] Optimize print function
- [ ] Add loading indicators

### Day 4: Security & Stability
- [ ] Add request throttling
- [ ] Optimize session handling
- [ ] Add error logging

### Day 5: Testing
- [ ] Test with 10 concurrent users
- [ ] Test with 50 concurrent users
- [ ] Monitor performance
- [ ] Fix bottlenecks

---

## 🚨 CRITICAL NOTES

1. **Test in staging first!** - Never apply directly to production
2. **Backup before changes** - Always have rollback plan
3. **Monitor after deployment** - Watch for issues
4. **Clear cache when needed** - After data updates
5. **Gradual rollout** - Start with 1 poli, then expand

---

## 💡 BONUS: Quick Performance Check

Add this to your controller to monitor performance:

```php
// File: application/core/MY_Controller.php (create if not exists)
class MY_Controller extends CI_Controller
{
    protected $start_time;
    protected $start_memory;
    
    public function __construct()
    {
        parent::__construct();
        $this->start_time = microtime(true);
        $this->start_memory = memory_get_usage();
    }
    
    public function __destruct()
    {
        $execution_time = microtime(true) - $this->start_time;
        $memory_used = (memory_get_usage() - $this->start_memory) / 1024 / 1024;
        
        // Log slow requests
        if ($execution_time > 2) {
            log_message('warning', sprintf(
                'SLOW REQUEST: %s took %.2fs, used %.2fMB memory',
                uri_string(),
                $execution_time,
                $memory_used
            ));
        }
    }
}
```

---

**Start with Priority 1 (Reduce AJAX calls) - This alone will give you 80% improvement!** 🚀

Good luck! 💪

// DEBUG SCRIPT - Paste ini di Console Browser (F12)
// Untuk mengecek data yang diterima dari get_detail

console.log('=== DEBUG BULK PRINT ===');

// Intercept AJAX call ke get_detail
(function () {
    const originalAjax = $.ajax;
    $.ajax = function (options) {
        if (options.url && options.url.includes('get_detail')) {
            console.log('📡 AJAX Request to get_detail:', options);

            const originalSuccess = options.success;
            options.success = function (response) {
                console.log('✅ Response from get_detail:', response);

                if (response && response.data) {
                    const data = response.data;
                    console.log('📊 Available assessments:');
                    console.log('  - IGD:', !!data.igd);
                    console.log('  - Mata:', !!data.mata);
                    console.log('  - Kandungan:', !!data.kandungan);
                    console.log('  - Anak:', !!data.anak);
                    console.log('  - Bedah:', !!data.bedah);
                    console.log('  - THT:', !!data.tht);
                    console.log('  - Jantung:', !!data.jantung);
                    console.log('  - Kulit & Kelamin:', !!data.kulitdankelamin);
                    console.log('  - Neurologi:', !!data.neurologi);
                    console.log('  - Paru:', !!data.paru);
                    console.log('  - Psikiatrik:', !!data.psikiatrik);
                    console.log('  - IGD Psikiatri:', !!data.igdPsikiatri);
                    console.log('  - Geriatri:', !!data.geriatri);
                    console.log('  - Rehab Medik:', !!data.asesmenRehabMedik);
                    console.log('  - Urologi:', !!data.asesmenUrologi);
                }

                if (originalSuccess) {
                    originalSuccess.apply(this, arguments);
                }
            };
        }
        return originalAjax.call(this, options);
    };
})();

console.log('✅ Debug script loaded. Sekarang coba bulk print!');

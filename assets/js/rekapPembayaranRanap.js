document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("filterForm");
  const exportBtn = document.getElementById("exportPdfBtn");
  const tbody = document.querySelector("#rekapTable tbody");
  const tfootGrand = document.getElementById("total_grand"); // <- target elemen Grand Total
  const startInput = document.getElementById("start_date");
  const endInput = document.getElementById("end_date");

  const today = new Date().toISOString().split("T")[0];
  startInput.value = today;
  endInput.value = today;

  form.addEventListener("submit", function (e) {
    e.preventDefault();
    loadData();
  });

  exportBtn.addEventListener("click", function () {
    const start = startInput.value;
    const end = endInput.value;
    window.open(`${PRINT_URL}?start_date=${start}&end_date=${end}`, "_blank");
  });

  function loadData() {
    const start = startInput.value;
    const end = endInput.value;

    fetch(`${API_URL}?start_date=${start}&end_date=${end}`)
      .then(res => res.json())
      .then(json => renderTable(json.data || []))
      .catch(err => {
        console.error("Error:", err);
        tbody.innerHTML = `<tr><td colspan="18" class="text-center text-danger">Gagal memuat data</td></tr>`;
        tfootGrand.innerText = "Rp 0";
      });
  }

  function renderTable(data) {
    tbody.innerHTML = "";
    let grandTotal = 0;

    if (data.length === 0) {
      tbody.innerHTML = `<tr><td colspan="18" class="text-center">Tidak ada data</td></tr>`;
      tfootGrand.innerText = "Rp 0";
      return;
    }

    data.forEach((item, index) => {
      const obat_komplit = (parseFloat(item.biaya_obat) || 0) + (parseFloat(item.biaya_ralan) || 0);
      const kamar_service = (parseFloat(item.biaya_kamar) || 0) + (parseFloat(item.biaya_service) || 0);
      const tindakan_total = (parseFloat(item.biaya_ranap_dokter) || 0) + (parseFloat(item.biaya_ranap_paramedis) || 0);

      const total_semua = parseFloat(item.total_biaya) || 0;
      grandTotal += total_semua;

      const row = `
        <tr>
          <td>${index + 1}</td>
          <td>${item.no_rkm_medis}</td>
          <td>${item.nm_pasien}</td>
          <td>${item.png_jawab}</td>
          <td>${item.nm_bangsal}</td>
          <td>${item.perujuk || "-"}</td>
          <td class="text-right">${formatRp(item.biaya_registrasi)}</td>
          <td class="text-right">${formatRp(tindakan_total)}</td>
          <td class="text-right">${formatRp(obat_komplit)}</td>
          <td class="text-right">${formatRp(item.biaya_retur_obat)}</td>
          <td class="text-right">${formatRp(item.biaya_resep_pulang)}</td>
          <td class="text-right">${formatRp(item.biaya_laborat)}</td>
          <td class="text-right">${formatRp(item.biaya_radiologi)}</td>
          <td class="text-right">${formatRp(item.biaya_potongan)}</td>
          <td class="text-right">${formatRp(item.biaya_tambahan)}</td>
          <td class="text-right">${formatRp(kamar_service)}</td>
          <td class="text-right">${formatRp(item.biaya_operasi)}</td>
          <td class="text-right font-weight-bold">${formatRp(total_semua)}</td>
        </tr>
      `;
      tbody.insertAdjacentHTML("beforeend", row);
    });

    // Set Grand Total ke tfoot
    tfootGrand.innerText = formatRp(grandTotal);
  }

  function formatRp(angka) {
    const num = parseFloat(angka) || 0;
    return num.toLocaleString("id-ID");
  }

  // Load default saat halaman dibuka
  loadData();
});

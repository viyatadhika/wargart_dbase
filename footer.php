<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<script>
  AOS.init({ duration: 800, once: true });

  document.addEventListener("DOMContentLoaded", function () {
    const lantaiSelect = document.getElementById("lantaiSelect");
    const asramaSelect = document.getElementById("asramaSelect");
    const tanggalInput = document.getElementById("tanggalInput");
    const namaPetugas = document.getElementById("namaPetugas");
    const nomorKamarField = document.getElementById("nomorKamarField");
    const nomorKamarInput = document.getElementById("nomorKamar"); 

    // Sections
    const areaKamar   = document.getElementById("areaKamar");
    const areaMandi   = document.getElementById("areaMandi");
    const amenities   = document.getElementById("amenities");
    const koridor     = document.getElementById("areaKoridor");
    const finalCheck  = document.getElementById("finalCheck");
    const uploadFoto  = document.getElementById("uploadFoto");
    const catatan     = document.getElementById("catatanKhusus");

    // Progress bar
    const progressBar = document.getElementById("progress-bar");
    const progressText = document.getElementById("progress-text");

    let totalCheckbox = 0;
    let allCheckboxes = [];

    // Update progress bar
    function updateProgress() { 
      let checked = allCheckboxes.filter(cb => cb.checked).length;
      let percent = totalCheckbox > 0 ? Math.round((checked / totalCheckbox) * 100) : 0;
      progressBar.style.width = percent + "%";
      progressText.innerText = percent + "% Complete";
    }

    // Bind semua checklist yang terlihat
    function bindCheckboxes() {
      allCheckboxes.forEach(cb => cb.removeEventListener("change", updateProgress));

      allCheckboxes = Array.from(document.querySelectorAll("input[type='checkbox']:not(:disabled)"))
        .filter(cb => !cb.closest(".hidden"));

      totalCheckbox = allCheckboxes.length;

      allCheckboxes.forEach(cb => cb.addEventListener("change", updateProgress));
      updateProgress();
    }

    // Reset hanya checklist + kamar + catatan + foto
      function resetPartial() {
        // reset checklist
        allCheckboxes.forEach(cb => cb.checked = false);
        document.querySelectorAll(".check-label").forEach(lbl => {
          lbl.style.textDecoration = "none";
          lbl.style.color = "#374151";
        });

        // reset nomor kamar
        const nomorKamarInput = document.querySelector("#nomorKamarField input");
        if (nomorKamarInput) nomorKamarInput.value = "";

        // reset catatan
        document.querySelectorAll("textarea").forEach(el => el.value = "");

        // reset file upload
        document.querySelectorAll("input[type='file']").forEach(input => input.value = "");
        document.querySelectorAll("img[id^='preview']").forEach(img => img.classList.add("hidden"));
        document.querySelectorAll("button[id^='remove']").forEach(btn => btn.classList.add("hidden"));

        // reset progress
        progressBar.style.width = "0%";
        progressText.innerText = "0% Complete";

        bindCheckboxes();
      }

      // Reset semua input, checklist, progress bar
      function resetForm() {
        resetPartial();
        tanggalInput.value = "";
        namaPetugas.value = "";
        asramaSelect.selectedIndex = 0;
        lantaiSelect.selectedIndex = 0;

        // sembunyikan semua section
        [nomorKamarField, areaKamar, areaMandi, amenities, koridor, finalCheck, uploadFoto, catatan]
          .forEach(el => el.classList.add("hidden"));
      }

      // Saat lantai berubah
      lantaiSelect.addEventListener("change", function () {
        const value = this.value;
        resetPartial();

        [nomorKamarField, areaKamar, areaMandi, amenities, koridor, finalCheck, uploadFoto, catatan]
          .forEach(el => el.classList.add("hidden"));

        if (value.includes("Koridor")) {
          nomorKamarField.classList.add("hidden");
          nomorKamarInput.required = false;
          nomorKamarInput.value = "-";
          koridor.classList.remove("hidden");
          finalCheck.classList.remove("hidden");
          uploadFoto.classList.remove("hidden");
          catatan.classList.remove("hidden");
        } else if (value.includes("Lantai")) {
          nomorKamarField.classList.remove("hidden");
          nomorKamarInput.required = true;
          nomorKamarInput.value = "";
          areaKamar.classList.remove("hidden");
          areaMandi.classList.remove("hidden");
          amenities.classList.remove("hidden");
          finalCheck.classList.remove("hidden");
          uploadFoto.classList.remove("hidden");
          catatan.classList.remove("hidden");
        }

        bindCheckboxes();
      });

      // Tombol reset manual
      const resetBtn = document.getElementById("resetFormBtn");
      resetBtn.addEventListener("click", resetForm);

      // Inisialisasi awal
      bindCheckboxes();
    });

  // Icon lucide
  lucide.createIcons();
</script>

<script>
  // ✅ Preview gambar + validasi ukuran max 2 MB
  function previewImage(event, previewId, removeBtnId) {
    const input = event.target;
    const file = input.files[0];
    const preview = document.getElementById(previewId);
    const removeBtn = document.getElementById(removeBtnId);

    if(file) {
      if(file.size > 2 * 1024 * 1024) { 
        alert("Ukuran file tidak boleh lebih dari 2 MB!");
        input.value = "";
        return;
      }

      const reader = new FileReader();
      reader.onload = function(e) {
        preview.src = e.target.result;
        preview.classList.remove('hidden');
        removeBtn.classList.remove('hidden');
      }
      reader.readAsDataURL(file);
    }
  }

  // ✅ Hapus gambar
  function removeImage(inputId, previewId, removeBtnId) {
    const input = document.getElementById(inputId);
    const preview = document.getElementById(previewId);
    const removeBtn = document.getElementById(removeBtnId);

    input.value = "";
    preview.src = "";
    preview.classList.add('hidden');
    removeBtn.classList.add('hidden');
  }

  // Event listener tombol hapus
  document.getElementById('removePekerjaan').addEventListener('click', () => {
    removeImage('foto_pekerjaan', 'previewPekerjaan', 'removePekerjaan');
  });
  document.getElementById('removeKerusakan').addEventListener('click', () => {
    removeImage('foto_kerusakan', 'previewKerusakan', 'removeKerusakan');
  });
  document.getElementById('removePelayanan').addEventListener('click', () => {
    removeImage('foto_pelayanan', 'previewPelayanan', 'removePelayanan');
  });

  // Klik container -> buka file dialog
  document.querySelectorAll('.relative.border-2.cursor-pointer').forEach(container => {
    const input = container.querySelector('input[type="file"]');
    container.addEventListener('click', () => input.click());
  });

  // Animasi coret checklist
  document.querySelectorAll('.check-item').forEach((checkbox) => {
    checkbox.addEventListener('change', function() {
      const label = this.closest('label').querySelector('.check-label');
      if(this.checked) {
        label.style.textDecoration = "line-through";
        label.style.transition = "all 0.3s ease";
        label.style.color = "#9ca3af"; // abu-abu
      } else {
        label.style.textDecoration = "none";
        label.style.color = "#374151";
      }
    });
  });
</script>

</body>
</html>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<script>
  // Checklist Asrama
  AOS.init({
    duration: 800,
    once: true
  });

  lucide.createIcons();
</script>

<script>
  document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("checklistForm");
    const tanggalInput = document.getElementById("tanggalInput");
    const namaPetugas = document.getElementById("namaPetugas");
    const asramaSelect = document.getElementById("asramaSelect");
    const lantaiSelect = document.getElementById("lantaiSelect");
    const ruanganSelect = document.getElementById("ruanganSelect");
    const nomorKamarField = document.getElementById("nomorKamarField");
    const rumahSelect = document.getElementById("rumahSelect");
    const nomorRumahField = document.getElementById("nomorRumahField");
    const uploadFoto = document.getElementById("uploadFoto");
    const catatanKhusus = document.getElementById("catatanKhusus");
    const actionSection = document.getElementById("actionSection");
    const progressBar = document.getElementById("progress-bar");
    const progressText = document.getElementById("progress-text");
    const resetBtn = document.getElementById("resetFormBtn");

    const areas = document.querySelectorAll(".checklist-area");

    // ✅ Update progress bar
    function updateProgress() {
      const visibleCheckboxes = document.querySelectorAll(
        ".checklist-area:not(.hidden) .check-item"
      );
      const total = visibleCheckboxes.length;
      const checked = [...visibleCheckboxes].filter(cb => cb.checked).length;
      const percent = total ? Math.round((checked / total) * 100) : 0;

      progressBar.style.width = percent + "%";
      progressText.textContent = percent + "% Complete";
    }

    // ✅ Reset hanya checklist, catatan & foto
    function resetChecklistOnly() {
      form.querySelectorAll(".check-item").forEach(cb => cb.checked = false);
      form.querySelectorAll(".check-label").forEach(lbl => {
        lbl.style.textDecoration = "none";
        lbl.style.color = "#374151";
      });

      if (nomorKamarField) nomorKamarField.querySelector("input").value = "";
      if (nomorRumahField) nomorRumahField.querySelector("input").value = "";
      form.querySelectorAll("textarea").forEach(el => el.value = "");
      form.querySelectorAll("input[type='file']").forEach(i => i.value = "");
      form.querySelectorAll("img[id^='preview']").forEach(img => img.classList.add("hidden"));
      form.querySelectorAll("button[id^='remove']").forEach(btn => btn.classList.add("hidden"));

      progressBar.style.width = "0%";
      progressText.textContent = "0% Complete";
    }

    // ✅ Reset full form
    function resetForm() {
      form.reset();
      resetChecklistOnly();
      areas.forEach(a => a.classList.add("hidden"));
      uploadFoto.classList.add("hidden");
      catatanKhusus.classList.add("hidden");
      actionSection.classList.remove("hidden");
    }

    // ✅ Handle pilihan Asrama / Auditorium / Rumpim
    function handleChecklist(value, type) {
      const savedTanggal = tanggalInput.value;
      const savedPetugas = namaPetugas.value;

      resetChecklistOnly();
      tanggalInput.value = savedTanggal;
      namaPetugas.value = savedPetugas;

      areas.forEach(area => area.classList.add("hidden"));
      if (nomorKamarField) nomorKamarField.classList.add("hidden");
      if (nomorRumahField) nomorRumahField.classList.add("hidden");

      if (type === "asrama") {
        if (value.includes("Lantai") && !value.includes("Koridor")) {
          if (nomorKamarField) nomorKamarField.classList.remove("hidden");
          document.querySelector('[data-area="Kamar Tidur"]').classList.remove("hidden");
          document.querySelector('[data-area="Kamar Mandi"]').classList.remove("hidden");
          document.querySelector('[data-area="Amenities"]').classList.remove("hidden");
          document.querySelector('[data-area="Final Check"]').classList.remove("hidden");
        } else if (value.includes("Koridor")) {
          document.querySelector('[data-area="Koridor"]').classList.remove("hidden");
          document.querySelector('[data-area="Final Check"]').classList.remove("hidden");
        }
      }

      if (type === "auditorium") {
        if (value.includes("Auditorium") || value.includes("Kelas")) {
          document.querySelector('[data-area="Area Ruangan"]').classList.remove("hidden");
          document.querySelector('[data-area="Perangkat Pendukung"]').classList.remove("hidden");
          document.querySelector('[data-area="Final Check"]').classList.remove("hidden");
        } else if (value.includes("Koridor")) {
          document.querySelector('[data-area="Koridor"]').classList.remove("hidden");
          document.querySelector('[data-area="Final Check"]').classList.remove("hidden");
        } else if (value.includes("Toilet")) {
          document.querySelector('[data-area="Toilet"]').classList.remove("hidden");
          document.querySelector('[data-area="Final Check"]').classList.remove("hidden");
        }
      }

      if (type === "rumpim") {
        if (value === "Rumah Dinas Eselon I") {
          if (nomorRumahField) nomorRumahField.classList.add("hidden");
          document.querySelector('[data-area="Area Utama"]').classList.remove("hidden");
          document.querySelector('[data-area="Kamar Mandi"]').classList.remove("hidden");
          document.querySelector('[data-area="Final Check"]').classList.remove("hidden");
        } else if (value.includes("Rumah Dinas")) {
          if (nomorRumahField) nomorRumahField.classList.remove("hidden");
          document.querySelector('[data-area="Area Utama"]').classList.remove("hidden");
          document.querySelector('[data-area="Kamar Mandi"]').classList.remove("hidden");
          document.querySelector('[data-area="Final Check"]').classList.remove("hidden");
        }
      }

      if (value) {
        uploadFoto.classList.remove("hidden");
        catatanKhusus.classList.remove("hidden");
        actionSection.classList.remove("hidden");
      }

      updateProgress();
    }

    // ✅ Event listener
    if (lantaiSelect) {
      lantaiSelect.addEventListener("change", () => {
        handleChecklist(lantaiSelect.value, "asrama");
      });
    }
    if (ruanganSelect) {
      ruanganSelect.addEventListener("change", () => {
        handleChecklist(ruanganSelect.value, "auditorium");
      });
    }
    if (rumahSelect) {
      rumahSelect.addEventListener("change", () => {
        handleChecklist(rumahSelect.value, "rumpim");
      });
    }
    form.addEventListener("change", (e) => {
      if (e.target.classList.contains("check-item")) updateProgress();
    });
    resetBtn.addEventListener("click", resetForm);
  });

  // Animasi coret checklist
  document.querySelectorAll('.check-item').forEach((checkbox) => {
    checkbox.addEventListener('change', function() {
      const label = this.closest('label').querySelector('.check-label');
      if (this.checked) {
        label.style.textDecoration = "line-through";
        label.style.transition = "all 0.3s ease";
        label.style.color = "#9ca3af"; // abu-abu
      } else {
        label.style.textDecoration = "none";
        label.style.color = "#374151";
      }
    });
  });

  // 🔹 Fungsi kompres gambar pakai <canvas>
  async function compressImage(file, maxSize = 1024, quality = 0.7) {
    return new Promise((resolve, reject) => {
      const reader = new FileReader();
      reader.readAsDataURL(file);

      reader.onload = event => {
        const img = new Image();
        img.src = event.target.result;

        img.onload = () => {
          let width = img.width;
          let height = img.height;

          // Resize kalau lebih besar dari maxSize
          if (width > height) {
            if (width > maxSize) {
              height *= maxSize / width;
              width = maxSize;
            }
          } else {
            if (height > maxSize) {
              width *= maxSize / height;
              height = maxSize;
            }
          }

          const canvas = document.createElement("canvas");
          canvas.width = width;
          canvas.height = height;

          const ctx = canvas.getContext("2d");
          ctx.drawImage(img, 0, 0, width, height);

          function tryCompress(q) {
            return new Promise((resolveQ) => {
              canvas.toBlob(
                blob => resolveQ(blob),
                "image/jpeg",
                q
              );
            });
          }

          (async () => {
            let q = quality;
            let blob = await tryCompress(q);

            // ✅ Loop turunkan kualitas sampai <= 1MB
            while (blob.size > 1 * 1024 * 1024 && q > 0.3) {
              q -= 0.1;
              blob = await tryCompress(q);
            }

            if (blob) {
              resolve(new File([blob], file.name, {
                type: "image/jpeg"
              }));
            } else {
              reject(new Error("Gagal kompres gambar"));
            }
          })();
        };

        img.onerror = () => reject(new Error("Gagal load gambar"));
      };

      reader.onerror = () => reject(new Error("Gagal baca file"));
    });
  }

  // 🔹 Event listener untuk semua input foto
  document.querySelectorAll(".foto-input").forEach(input => {
    input.addEventListener("change", async (event) => {
      let file = event.target.files[0];
      if (!file) return;

      // ✅ Validasi tipe file (hanya JPG/PNG)
      const allowedTypes = ["image/jpeg", "image/png", "image/jpg"];
      if (!allowedTypes.includes(file.type)) {
        alert("Hanya file gambar JPG atau PNG yang diperbolehkan!");
        input.value = "";
        return;
      }

      // ✅ Jika > 1MB → kompres dulu
      if (file.size > 1 * 1024 * 1024) {
        alert("Ukuran file > 1MB, sedang dikompres...");
        file = await compressImage(file, 1024, 0.7);
      }

      // ✅ tampilkan preview
      const previewId = "preview-" + input.id;
      const removeId = "remove-" + input.id;
      const preview = document.getElementById(previewId);
      const removeBtn = document.getElementById(removeId);

      const reader = new FileReader();
      reader.onload = e => {
        preview.src = e.target.result;
        preview.classList.remove("hidden");
        removeBtn.classList.remove("hidden");
      };
      reader.readAsDataURL(file);

      // ✅ ganti file asli dengan file hasil kompres
      const dt = new DataTransfer();
      dt.items.add(file);
      input.files = dt.files;
    });
  });

  // 🔹 Tombol hapus preview
  document.querySelectorAll(".remove-btn").forEach(button => {
    button.addEventListener("click", (e) => {
      e.stopPropagation();
      const inputId = button.id.replace("remove-", "");
      const input = document.getElementById(inputId);
      const preview = document.getElementById("preview-" + inputId);

      input.value = "";
      preview.src = "";
      preview.classList.add("hidden");
      button.classList.add("hidden");
    });
  });

  // 🔹 Klik container → buka file dialog
  document.querySelectorAll(".foto-container").forEach(container => {
    const input = container.querySelector(".foto-input");
    container.addEventListener("click", (e) => {
      if (!e.target.classList.contains("remove-btn")) {
        input.click();
      }
    });
  });
</script>
</body>

</html>
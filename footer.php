    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
    AOS.init({ duration: 800, once: true });

    // Progress bar update
    const checkboxes = document.querySelectorAll('.checklist input[type="checkbox"]');
    const progressBar = document.getElementById('progress-bar');
    const progressText = document.getElementById('progress-text');
    const resetBtn = document.getElementById('resetBtn');

    function updateProgress() {
        const checked = document.querySelectorAll('.checklist input[type="checkbox"]:checked').length;
        const total = checkboxes.length;
        const percent = total ? Math.round((checked / total) * 100) : 0;

        progressBar.style.width = percent + "%";
        progressText.textContent = percent + "% Complete";
    }

    checkboxes.forEach(cb => cb.addEventListener('change', updateProgress));
    resetBtn.addEventListener('click', () => {
        checkboxes.forEach(cb => cb.checked = false);
        updateProgress();
    });
    </script>
    </body>
</html>
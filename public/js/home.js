document.addEventListener("DOMContentLoaded", async function() {
    const feedContainer = document.getElementById("image-feed");

    async function loadImages() {
        try {
            let response = await fetch("/api/images.php");
            let data = await response.json();

            if (data.status === "success") {
                feedContainer.innerHTML = data.data.map(img => `
                    <div>
                        <img src="${img.file_path}" width="300" />
                        <p>${img.title}</p>
                    </div>
                `).join('');
            }
        } catch (error) {
            console.error("Error loading images:", error);
        }
    }

    loadImages();
});

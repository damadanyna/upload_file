document.getElementById('fileInput').addEventListener('change', function () {
    const fileList = document.getElementById('fileList');
    fileList.innerHTML = '<ul>' + Array.from(this.files).map(file => `<li>${file.name}</li>`).join('') + '</ul>';
});

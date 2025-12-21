// SIMPLIFIED CANVAS INIT - Copy paste this to browser console to test
const testCanvas = document.getElementById('canvasLokalis');
if (testCanvas) {
    const testCtx = testCanvas.getContext('2d');
    const testImg = new Image();
    testImg.onload = function () {
        testCtx.drawImage(testImg, 0, 0, testCanvas.width, testCanvas.height);
        console.log('✅ Image loaded! Size:', testImg.width, 'x', testImg.height);
    };
    testImg.onerror = function () {
        console.error('❌ Failed to load image');
    };
    testImg.src = 'http://127.0.0.1/moizhospitalapps/assets/images/status_lokalis_anak.png';
    console.log('🔄 Loading image from:', testImg.src);
} else {
    console.error('❌ Canvas not found!');
}

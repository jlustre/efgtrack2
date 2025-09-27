{{--
Landing Page Video Functions JavaScript Component
Contains all video modal functionality
--}}
<script>
    function openVideoModal() {
        const modal = document.getElementById('videoModal');
        const iframe = document.getElementById('videoFrame');
        iframe.src = 'https://www.youtube.com/embed/u31qwQUeGuM?autoplay=1&rel=0';
        modal.style.display = 'flex';
    }

    function closeVideoModal() {
        const modal = document.getElementById('videoModal');
        const iframe = document.getElementById('videoFrame');
        iframe.src = '';
        modal.style.display = 'none';
    }

    function openFeatureVideo(videoUrl) {
        // Close feature modal first
        closeFeatureModal();
        
        // Open video modal with the feature video
        const modal = document.getElementById('videoModal');
        const iframe = document.getElementById('videoFrame');
        const title = document.querySelector('#videoModal h3');
        
        // Update title for feature video
        title.textContent = 'Feature Tutorial Video';
        iframe.src = videoUrl;
        modal.style.display = 'flex';
    }
</script>
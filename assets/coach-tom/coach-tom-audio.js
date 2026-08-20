(() => {
  const formatTime = (seconds) => {
    if (!Number.isFinite(seconds)) return '0:00';
    const minutes = Math.floor(seconds / 60);
    return `${minutes}:${String(Math.floor(seconds % 60)).padStart(2, '0')}`;
  };

  document.querySelectorAll('.ctw-audio').forEach((player) => {
    const audio = player.querySelector('.ctw-audio__media');
    const toggle = player.querySelector('.ctw-audio__toggle');
    const icon = player.querySelector('.ctw-audio__icon');
    const action = player.querySelector('.ctw-audio__action');
    const seek = player.querySelector('.ctw-audio__seek');
    const current = player.querySelector('.ctw-audio__current');
    const duration = player.querySelector('.ctw-audio__duration');
    if (!audio || !toggle || !seek) return;

    const setPlayingState = (playing) => {
      icon.textContent = playing ? '||' : '>';
      action.textContent = playing ? 'Pause welcome' : 'Play welcome';
      toggle.setAttribute('aria-label', playing ? 'Pause Coach Tom Welcomes Everyone' : 'Play Coach Tom Welcomes Everyone');
    };

    audio.addEventListener('loadedmetadata', () => { duration.textContent = formatTime(audio.duration); });
    audio.addEventListener('timeupdate', () => {
      current.textContent = formatTime(audio.currentTime);
      seek.value = audio.duration ? String((audio.currentTime / audio.duration) * 100) : '0';
    });
    audio.addEventListener('ended', () => setPlayingState(false));
    audio.addEventListener('pause', () => setPlayingState(false));
    audio.addEventListener('play', () => setPlayingState(true));

    toggle.addEventListener('click', () => {
      if (audio.paused) {
        document.querySelectorAll('.ctw-audio__media').forEach((other) => { if (other !== audio) other.pause(); });
        audio.play().catch(() => setPlayingState(false));
      } else {
        audio.pause();
      }
    });

    seek.addEventListener('input', () => {
      if (audio.duration) audio.currentTime = (Number(seek.value) / 100) * audio.duration;
    });
  });
})();

/**
 * Portfolio Dagi – Frontend-Skripte
 * 1. Mobile Navigation
 * 2. Work-Filter nach Disziplin
 * 3. Hover-Loops auf den Projektkarten
 * 4. Soundtrack-Player
 */

const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

// -> 1. Mobile Navigation öffnen / schliessen
const navToggle = document.querySelector('.nav-toggle');
const nav = document.querySelector('#main-nav');

if (navToggle && nav) {
    const setOpen = (open) => {
        navToggle.setAttribute('aria-expanded', String(open));
        navToggle.setAttribute('aria-label', open ? 'Close menu' : 'Open menu');
        nav.classList.toggle('is-open', open);
    };
    navToggle.addEventListener('click', () => {
        setOpen(navToggle.getAttribute('aria-expanded') !== 'true');
    });
    // -> nach einem Klick auf einen Anker-Link schliessen
    nav.querySelectorAll('a').forEach((link) => {
        link.addEventListener('click', () => setOpen(false));
    });
    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && nav.classList.contains('is-open')) {
            setOpen(false);
            navToggle.focus();
        }
    });
}

// -> 2. Work-Filter: blendet Karten nach Disziplin ein und aus
document.querySelectorAll('[data-module="work"]').forEach((work) => {
    const filter = work.querySelector('[data-filter]');
    const items = work.querySelectorAll('.work-item');
    const count = work.querySelector('[data-work-count]');
    if (!filter) {
        return;
    }
    const buttons = filter.querySelectorAll('.filter-button');

    buttons.forEach((button) => {
        button.addEventListener('click', () => {
            const value = button.dataset.filterValue;
            let visible = 0;

            items.forEach((item) => {
                const slugs = (item.dataset.disciplines || '').split(' ');
                const show = value === 'all' || slugs.includes(value);
                item.hidden = !show;
                if (show) {
                    visible++;
                }
            });

            buttons.forEach((other) => {
                const active = other === button;
                other.classList.toggle('is-active', active);
                other.setAttribute('aria-pressed', String(active));
            });

            if (count) {
                count.textContent = `(${String(visible).padStart(2, '0')})`;
            }
        });
    });
});

// -> 3. Hover-Loops: spielen nur, solange man auf die Karte zeigt
if (!reduceMotion) {
    document.querySelectorAll('.project-card').forEach((card) => {
        const video = card.querySelector('.project-card-video');
        if (!video) {
            return;
        }
        const play = () => {
            video.preload = 'auto';
            video.play().then(() => card.classList.add('is-playing')).catch(() => {});
        };
        const stop = () => {
            card.classList.remove('is-playing');
            video.pause();
            video.currentTime = 0;
        };
        card.addEventListener('mouseenter', play);
        card.addEventListener('mouseleave', stop);
        card.addEventListener('focus', play);
        card.addEventListener('blur', stop);
    });
}

// -> 4. Soundtrack-Player
const formatTime = (seconds) => {
    if (!Number.isFinite(seconds)) {
        return '0:00';
    }
    const minutes = Math.floor(seconds / 60);
    const rest = String(Math.floor(seconds % 60)).padStart(2, '0');
    return `${minutes}:${rest}`;
};

document.querySelectorAll('[data-player]').forEach((player) => {
    const audio = player.querySelector('[data-player-audio]');
    const toggle = player.querySelector('[data-player-toggle]');
    const seek = player.querySelector('[data-player-seek]');
    const time = player.querySelector('[data-player-time]');
    const bars = player.querySelectorAll('[data-player-wave] span');

    const render = () => {
        const progress = audio.duration ? audio.currentTime / audio.duration : 0;
        const played = Math.round(progress * bars.length);
        bars.forEach((bar, index) => bar.classList.toggle('is-played', index < played));
        seek.value = String(Math.round(progress * 1000));
        time.textContent = audio.duration
            ? `${formatTime(audio.currentTime)} / ${formatTime(audio.duration)}`
            : formatTime(audio.currentTime);
    };

    toggle.addEventListener('click', () => {
        if (audio.paused) {
            // -> nur ein Player gleichzeitig
            document.querySelectorAll('[data-player-audio]').forEach((other) => {
                if (other !== audio) {
                    other.pause();
                }
            });
            audio.play();
        } else {
            audio.pause();
        }
    });

    audio.addEventListener('play', () => {
        player.classList.add('is-playing');
        toggle.setAttribute('aria-label', 'Pause soundtrack');
    });
    audio.addEventListener('pause', () => {
        player.classList.remove('is-playing');
        toggle.setAttribute('aria-label', 'Play soundtrack');
    });
    audio.addEventListener('timeupdate', render);
    audio.addEventListener('loadedmetadata', render);
    audio.addEventListener('ended', () => {
        audio.currentTime = 0;
        render();
    });

    seek.addEventListener('input', () => {
        if (audio.duration) {
            audio.currentTime = (Number(seek.value) / 1000) * audio.duration;
            render();
        }
    });
});

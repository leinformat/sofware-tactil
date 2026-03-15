import * as utils from './utils/utils.js';

const clock = () => {
    const clock = document.querySelector('.top-bar-icon__clock');
    clock.innerHTML = utils.updateClock();

    setInterval(() => {
        clock.innerHTML = utils.updateClock();
    }, 1000);
}

clock();
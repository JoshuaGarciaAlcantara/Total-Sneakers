import { images } from '../scripts/images.js'

    const main = document.querySelector('main')
    const MAX_FRAMES = 48
    let currentFrame = 0

    function updateImage(frame = 0) {
      const src = images[frame].p
      console.log(src)
      img.src = src
    }

    const img = document.createElement('img')
    main.appendChild(img)
    updateImage(currentFrame)

    // our max scroll height
    let maxScroll = document.documentElement.scrollHeight - window.innerHeight;
    window.addEventListener('resize', () => {
      maxScroll = document.documentElement.scrollHeight - window.innerHeight;
    });

    let lastFrameUpdate = 0

    window.addEventListener('scroll', () => {
      if (Date.now() - lastFrameUpdate < 1) return true
      // update container
      lastFrameUpdate = Date.now()
      // curretn scroll position
      const scrollPosition = window.scrollY
      // calculate scroll percent
      const scrollFraction = scrollPosition / maxScroll;
      // What frame is next? Returns the neext integer for frames
      const frame = Math.floor(scrollFraction * MAX_FRAMES)
      // nos evitemos algo de trabajo cuando
      // al hacer scroll, el frame que le toca es el mismo
      // que ya tenía
      if (currentFrame !== frame) {
        // creamos el id del nombre del archivo
        updateImage(frame)
        currentFrame = frame
      }
    });
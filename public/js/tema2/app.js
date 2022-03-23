
var url = new URL(window.location.href);
var u = url.searchParams.get("u");
if (u==null || u=="") {
    document.getElementById('guest').innerHTML = "Guest";
} else {
    document.getElementById('guest').innerHTML = u;
}

document.addEventListener('DOMContentLoaded', function() {
    /* 
    |======================================
    | APP INIT 
    |======================================
    */
    AOS.init();
    
    /* 
    |======================================
    | OPENING SCRIPT
    |======================================
    */
    // animate spouse text opening
    const headerSpouseText = document.querySelector('#header h1');
    headerSpouseText.innerHTML = headerSpouseText.textContent.replace(/\S/g, "<span class='letter'>$&</span>");
    anime.timeline()
        .add({
            targets: '#header h1 .letter',
            scale: [4,1],
            opacity: [0,1],
            translateZ: 0,
            easing: "easeOutExpo",
            duration: 950,
            delay: (el, i) => 150*i
        });
    // btn sound and open the opening
    const btn_open = document.querySelector('#btn-open-opening');
    const btn_play = document.querySelector('#btn-play');
    const audio = document.querySelector('#audio');
    btn_open.addEventListener('click', function(e) {
        for(let aos of document.querySelectorAll('.aos-init')) {
            aos.classList.remove('aos-animate');
        }
        setTimeout(() => {
            AOS.refresh();
        }, 2000);

    })
    btn_play.addEventListener('click', function() {
        if (audio.paused) {
            btn_play.innerHTML = '<i class="ri ri-volume-high"></i>';
            audio.play();
        } else {
            btn_play.innerHTML = '<i class="ri ri-volume-off"></i>';
            audio.pause();
        }
    })
   

    /* 
    |======================================
    | PAGE SCRIPT
    |======================================
    */
    // timezz : countdown
    // timezz('#countdown-row-1, #countdown-row-2', {
    //     date: new Date("{{$data->tanggal_nikah}}"),
    //     stop: false,
    //     canContinue: false,
    //     withYears: false,
    //     beforeCreate() {},
    //     beforeDestroy() {},
    //     update(event) {},
    // });


    // tinyslider : gallery
    var sliderGallery1 = tns({
        container: '#tinyslider-container-gallery-1',
        controlsContainer: "#tinyslider-controls-gallery-1",
        items: 1,
        nav: false,
        center: true,
        mouseDrag: true,
        gutter: 10,
        swipeAngle: false,
        edgePadding: 10,
        responsive: {
            568: {
                items: 2,
                gutter: 20,
            },
            992: {
                items: 4.3,
                gutter: 30,
                edgePadding: 0,
            }
        }
    });
    var sliderGallery2 = tns({
        container: '#tinyslider-container-gallery-2',
        controlsContainer: "#tinyslider-controls-gallery-2",
        items: 1,
        nav: false,
        center: true,
        mouseDrag: true,
        gutter: 10,
        swipeAngle: false,
        edgePadding: 10,
        responsive: {
            568: {
                items: 1.1,
                gutter: 20,
                center: false,
            },
            992: {
                items: 2,
                gutter: 30,
                center: true,
                edgePadding: 0,
            }
        }
    });

    sliderGallery1.getInfo().slideItems[sliderGallery1.getInfo().index].classList.add('active');
    sliderGallery1.events.on('indexChanged', () => {
        const info = sliderGallery1.getInfo();
        const indexPrev = info.indexCached;
        const indexCurr = info.index;
        for (let i = 0; i < sliderGallery1.getInfo().slideItems.length; i++) {
            sliderGallery1.getInfo().slideItems[i].classList.remove('active');
        }
        info.slideItems[indexCurr].classList.add('active');
    });
    sliderGallery2.getInfo().slideItems[sliderGallery2.getInfo().index].classList.add('active');
    sliderGallery2.events.on('indexChanged', () => {
        const info = sliderGallery2.getInfo();
        const indexPrev = info.indexCached;
        const indexCurr = info.index;
        for (let i = 0; i < sliderGallery2.getInfo().slideItems.length; i++) {
            sliderGallery2.getInfo().slideItems[i].classList.remove('active');
        }
        info.slideItems[indexCurr].classList.add('active');
    });


    // tinyslider : message
    // var sliderMessage1 = tns({
    //     container: '#tinyslider-container-message',
    //     controlsContainer: "#tinyslider-controls-message",
    //     items: 1.2,
    //     nav: false,
    //     mouseDrag: true,
    //     gutter: 30,
    //     swipeAngle: false,
    //     responsive: {
    //         568: {
    //             items: 2.2,
    //             gutter: 20,
    //         },
    //         992: {
    //             items: 2.6,
    //             gutter: 30,
    //         }
    //     }
    // });

    // lightgallery : image lightbox popup
    // lightGallery(document.getElementById('row-lightgallery'), {
    //     mode: 'lg-fade',
    //     cssEasing: 'ease-in',
    //     speed: 1000,
    //     startClass: 'lg-fade',
    //     backdropDuration: 500,
    //     hideBarsDelay: 500,
    //     selector: '[data-src]',
    //     download: false,
    // });
    // page href smooth scroll
    const btn_href_page = document.querySelectorAll('.page-scroll');
    for (let btn of btn_href_page) {
        btn.addEventListener('click', function(e) {
            window.scrollTo({
                top: document.querySelector(`${this.getAttribute('href')}`).offsetTop - 80,
                behavior: 'smooth'
            });
            e.preventDefault();
        })
    }
    // back to top & nav-item active class
    const btn_to_top = document.querySelector('#btn-to-top');
    const navbar = document.querySelector('.navbar');
    const navlinks = document.querySelectorAll('.nav-link.page-scroll');
    let str_section_query = "";
    for (let indexNavlink = 0; indexNavlink < navlinks.length; indexNavlink++) {
        if (indexNavlink !== navlinks.length-1) {
            str_section_query += `${navlinks[indexNavlink].getAttribute('href')}, `;
        } else {
            str_section_query += `${navlinks[indexNavlink].getAttribute('href')}`;
        }
    }
    sectionlistener = document.querySelectorAll(str_section_query);
    window.addEventListener('scroll', function() {
        if (window.scrollY > 50) {
            navbar.classList.add('navbar-scrolled');
            btn_to_top.style.display = 'flex';
        } else {
            navbar.classList.remove('navbar-scrolled');
            btn_to_top.style.display = 'none';
        }

        for (let link of document.querySelectorAll('.nav-link')) {
            link.classList.remove('active');
        }
        for (let section of sectionlistener) {
            if (
                window.scrollY > (section.offsetTop - 100) &&
                window.scrollY < (section.offsetTop + section.offsetHeight)
            ) {
                for (let link of document.querySelectorAll('.nav-link')) {
                    link.classList.remove('active');
                }
                document.querySelector(`.nav-link[href="#${section.id}"]`).classList.add('active');
            }
        }
    })
    
});
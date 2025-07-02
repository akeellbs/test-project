import React from 'react';
import Slider from 'react-slick';

const SliderComponent = () => {
    const settings = {
        dots: true,
        infinite: true,
        speed: 500,
        arrows:false,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        vertical: true,
        verticalSwiping: true
    };

    return (
        <Slider {...settings}>
            <div><img src="https://cdn.motion.ac.in/ssp/img/jee-rank-predictor/image-49.png" className='result-img' alt="Slide 1" /></div>
            <div><img src="https://cdn.motion.ac.in/ssp/img/jee-rank-predictor/image-50.png" className='result-img'  alt="Slide 2" /></div>
            <div><img src="https://cdn.motion.ac.in/ssp/img/jee-rank-predictor/image-51.png" className='result-img' alt="Slide 3" /></div>
        </Slider>
    );
};

export default SliderComponent;

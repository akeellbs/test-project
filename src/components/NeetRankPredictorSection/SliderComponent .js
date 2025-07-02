import React from "react";
import Slider from "react-slick";

const SliderComponent = () => {
  const settings = {
    dots: true,
    infinite: true,
    speed: 500,
    arrows: false,
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    vertical: true,
    verticalSwiping: true,
  };

  return (
    <Slider {...settings}>
      <div>
        <a href="https://motion.ac.in/courses/12th-pass-neet/">
        <img
          src="https://cdn.motion.ac.in/ssp/img/neet-rank-predictor/neet_result_2023_lp_mobile.png"
          alt="Slide 1"
        />
        </a>
       
      </div>
      <div>
        <img
          src="https://cdn.motion.ac.in/ssp/img/neet-rank-predictor/image-50.png"
          alt="Slide 2"
        />
      </div>
      <div>
        <img
          src="https://cdn.motion.ac.in/ssp/img/NEET-Motion-Prayash.jpg"
          alt="Slide 3"
        />
      </div>
      <div>
        <img
          src="https://cdn.motion.ac.in/ssp/img/neet-rank-predictor/scholarship.jpg"
          alt="Slide 4"
        />
      </div>
    </Slider>
  );
};

export default SliderComponent;

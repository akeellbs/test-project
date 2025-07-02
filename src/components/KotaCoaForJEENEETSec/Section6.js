import React from "react";
import Slider from "react-slick";
import SliderComponent from "./SliderComponent ";

const Section6 = ({styles}) => {
  return (
    <section className={styles.section_5}>
      <div className={`container ${styles.student_says}`}>
        <div className="row justify-content-center">
          <div className="col-md-5">
            <h2 className={styles.nv_title}>Best Selection Ratio</h2>
            <div className={styles.student_say}>
              <img
                src="https://cdn.motion.ac.in/ssp/img/amrit/nv-sir-result.png"
                alt="nv-sir-results"
                data-aos="zoom-out-right"
                className={styles.nv_sir}
              />
            </div>
          </div>
          <div className="col-md-7 sliders">
            <h2 className="slider-title">What Our Student Says</h2>
            <div className="student-slider">
                <SliderComponent/>
            </div>
          </div>
        </div>
      </div>
    </section>
  );
};

export default Section6;

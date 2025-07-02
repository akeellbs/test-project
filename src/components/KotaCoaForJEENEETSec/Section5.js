import React from "react";
import { FaArrowRight } from "react-icons/fa";

const Section5 = ({styles}) => {
  return (
    <section className={styles.section_4}>
      <img
        src="https://cdn.motion.ac.in/ssp/img/jee-free-course-img/yellow-group.png"
        alt="jee-free-course"
        className={styles.yellow_group}
      />
      <div className="container-fluid">
        <div className="row">
          {/* Left Content */}
          <div className={`col-md-7 ${styles.best_place}`}>
            <div className={styles.best_pl}>
              <h3>Best Place For Learning!</h3>
              <h4>
                Download the <span>Motion Learning App</span>
              </h4>
              <ul>
                <li>
                  <FaArrowRight /> Free Access to <span>JEE/NEET PYQ’s</span>
                </li>
                <li>
                  <FaArrowRight /> Stay updated with <span>Latest Exam News</span>
                </li>
                <li>
                  <FaArrowRight /> All courses available at <span>Single Click</span>
                </li>
                <li>
                  <FaArrowRight /> JEE/NEET online learning <span>at an Affordable Price</span>
                </li>
                <li>
                  <FaArrowRight /> Get instant solution through <span>Scan Your Doubt Feature</span>
                </li>
              </ul>
            </div>
          </div>

          {/* Right Content */}
          <div className="col-md-5">
            <div className={styles.learning_app}>
              <h3>Best Place for Learning!</h3>
              <h4>
                Download the <span>Motion Learning App</span>
              </h4>
              <img
                src="https://cdn.motion.ac.in/ssp/img/kota-coaching-latest-img/motion-learning-app.png"
                alt="cuet-board"
                className={styles.learning_app}
              />
            </div>
          </div>
        </div>
      </div>
    </section>
  );
};

export default Section5;

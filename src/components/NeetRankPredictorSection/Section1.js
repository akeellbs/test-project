import React from "react";

const Section1 = ({styles}) => (
  <section className={styles.section_1}>
    <div className="container-fluid">
      <div className="row">
        <div className={`col-lg-8 col-md-6 col-sm-6 ${styles.rank_title}`}>
          <div className={styles.neet_rank}>
            <h1>NEET Rank Predictor 2025</h1>
            <p>
              Please input your NEET 2025 Marks to know your predictive rank in
              NEET 2025 Exam
            </p>
          </div>
        </div>
        <div className="col-lg-4 col-md-6 col-sm-6">
          <div className={styles.medikit}>
            <img
              src="https://cdn.motion.ac.in/ssp/img/neet-rank-predictor/medikit.png"
              alt="Medikit"
              className={styles.medikit_img}
            />
          </div>
        </div>
      </div>
    </div>
  </section>
);

export default Section1;

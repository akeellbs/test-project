import React from "react";

const Section4 = ({styles}) => {
  return (

        <section className={styles.section_4}>
          <img src="https://cdn.motion.ac.in/ssp/img/neet-rank-predictor/image-52.png" className={styles.nv_img} alt="NEET Rank Predictor"/>
          <img src="https://cdn.motion.ac.in/ssp/img/neet-rank-predictor/vector-1.png" className={styles.nv_img_vector} alt="NEET Rank Predictor"/>
          <div className="container">
            <div className="row">
              <div className="col-md-8">
                <div className={styles.neet_rank_pre}>
                  <h2>NEET Rank Predictor 2025</h2>
                  <p>
                    NEET 2025 Rank Predictor – After the NEET test is completed
                    and the exam is over, everyone would like to know some idea
                    of the ranking to be aware of where they stand. Now it’s
                    easy to calculate an estimated rank by using an easy tool
                    called the NEET Rank Predictor 2025 Here. Candidates wanting
                    to know what their NEET rank is can verify their score prior
                    to the announcement of the results. The NEET Rank Predictor
                    2025 will assist candidates to estimate the most likely
                    position. It will also assist candidates to determine their
                    eligibility to get admission by allowing 15 percent All
                    India Quota counselling.
                  </p>
                </div>
              </div>
              <div className="col-md-4">
                <div className={styles.nvsir}></div>
              </div>
            </div>
          </div>
        </section>
  );
};

export default Section4;

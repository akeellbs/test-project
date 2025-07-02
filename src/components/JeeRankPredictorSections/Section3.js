import React from 'react';

const Section3 = ({styles}) => {
  return (
    <section className={styles.section_3}>
      <img
        src="https://cdn.motion.ac.in/ssp/img/jee-rank-predictor/image-52.png"
        alt="Background"
        className={styles.nv_img}
      />
      <img
        src="https://cdn.motion.ac.in/ssp/img/jee-rank-predictor/vector-1.png"
        alt="Vector Design"
        className={styles.vector_angle}
      />
      <div className="container mx-auto px-4 relative z-10">
        <div className="row flex flex-wrap">
          {/* Text Content */}
          <div className="col-md-8 w-full md:w-2/3">
            <div className="jee-rank-pre">
              <h2 className="text-2xl font-bold mb-4">JEE Main 2025 Rank Predictor</h2>
              <p className="mb-4">
                After completing the JEE Main 2025 exam, one of the primary concerns for students is predicting their
                rank, which greatly impacts their future prospects and chances of admission to their desired college. If
                you're in this situation, worry not, as we're here to lend a helping hand!
              </p>
              <p className="mb-4">
                Our JEE Main Rank Predictor 2025 is designed to assist students in estimating their ranks based on their
                percentile and scores, analyzed from the JEE Main Answer Key 2025 released by Motion. It runs an
                automated analysis to suggest potential colleges based on predicted ranks.
              </p>
              <p>
                With the JEE Main 2025 rank and college predictor tool, candidates can anticipate their expected ranks
                and potential colleges before the official results are out. This tool is freely available on Motion’s
                website for candidates to make use of. Discover how our rank predictor can aid you in determining your
                likely JEE Main score and the colleges you may qualify for.
              </p>
            </div>
          </div>
          {/* Empty Placeholder (for image alignment) */}
          <div className="col-md-4 w-full md:w-1/3">
            <div className="nvsir h-full"></div>
          </div>
        </div>
      </div>
    </section>
  );
};

export default Section3;

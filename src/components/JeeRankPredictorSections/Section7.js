import React from 'react';

const Section7 = ({styles}) => {
  return (
    <section className={`${styles.section_7} py-8`}>
      <div className="container mx-auto px-4">
        <h2 className="text-3xl font-bold text-center mb-6">
          How to Predict Engineering Colleges using JEE Main Rank?
        </h2>
        <p className={`text-lg text-justify ${styles.leading_relaxed}`}>
          Motion offers the JEE Main College Predictor tool to simplify the process for students. This tool enables
          candidates to anticipate their potential colleges using their expected ranks. Leveraging advanced algorithms
          and data from previous years' JEE Main counseling sessions, the JEE Main 2025 College Predictor suggests the
          most suitable college options based on entered expected ranks. To utilize this tool, candidates simply need
          to register on the page and gain insights into their prospective engineering colleges.
        </p>
      </div>
    </section>
  );
};

export default Section7;

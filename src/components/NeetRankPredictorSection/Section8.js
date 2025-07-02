import React from 'react';

const Section8 = ({styles}) => {
  return (
    <section className={styles.section_8}>
      <div className="container">
        <h2>How to Predict Medical Colleges using NEET Rank?</h2>
        <p>
          For the ease of students, Motion has provided the NEET College Predictor tool; so that candidates can predict their probable colleges based on their expected ranks. The{' '}
          <a href="https://motion.ac.in/neet-college-predictor/" target="_blank" rel="noopener noreferrer">
            NEET 2025 College Predictor
          </a>{' '}
          tool uses advanced algorithms and opening & closing ranks of previous year's NEET counselling data to predict the best possible college for students based on the entered expected ranks. To access the same, candidates will have to simply register for the same here at the page and get an idea of their future medical college.
        </p>
      </div>
    </section>
  );
};

export default Section8;

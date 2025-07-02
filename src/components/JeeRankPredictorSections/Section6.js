import React from 'react';

const Section6 = ({styles}) => {
  return (
    <section className={`${styles.section_6} py-8`}>
      <div className="container mx-auto px-4">
        <h2 className="text-3xl font-bold text-center mb-6">
          Know All About JEE Main 2025 Counselling Process
        </h2>
        <p className={`text-lg text-justify ${styles.leading_relaxed}`}>
          The seat allotment in JEE Main is done through JoSAA. The Joint Seat Allocation Authority (JoSAA) has been set
          up by the Ministry of Education to manage and regulate the joint seat allocation for admissions to 118
          institutes. This includes 23 IITs, 31 NITs, IIEST Shibpur, 26 IIITs, and 38 Other Technical Institutes
          Funded Fully or Partially by Central or State Government (Other-GFTIs). Admission to all the academic
          programs offered by these Institutes will be made through a single platform i.e., JoSAA.
        </p>
      </div>
    </section>
  );
};

export default Section6;

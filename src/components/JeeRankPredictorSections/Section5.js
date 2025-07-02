import React from 'react';

const Section5 = ({styles}) => {
  const advantages = [
    {
      imgSrc: "https://cdn.motion.ac.in/ssp/img/jee-rank-predictor/frame-1.png",
      text: "Provides insight into your position within the JEE Main competition.",
    },
    {
      imgSrc: "https://cdn.motion.ac.in/ssp/img/jee-rank-predictor/frame-2.png",
      text: "The predicted JEE Main rank reflects the candidate's performance in the entrance exam.",
    },
    {
      imgSrc: "https://cdn.motion.ac.in/ssp/img/jee-rank-predictor/frame-3.png",
      text: "By utilizing the rank predicted through the JEE Main predictor, candidates can compile a list of potential engineering colleges for admission based on past years' trends.",
    },
  ];

  return (
    <section className={`${styles.section_5} py-8`}>
      <div className="container mx-auto px-4">
        <h2 className="text-3xl font-bold text-center mb-8">
          Advantages of JEE Main 2025 Rank Predictor:
        </h2>
        <div className="row pt-3 flex flex-wrap justify-center">
          {advantages.map((advantage, index) => (
            <div
              className="col-md-4 mb-6"
              key={index}
            >
              <div className={`${styles.frame} border rounded-lg shadow-md p-4`}>
                <div className="fram-img mb-4 text-center">
                  <img
                    src={advantage.imgSrc}
                    alt={`Advantage ${index + 1}`}
                    className="max-w-full mx-auto"
                  />
                </div>
                <div className={styles.frame_text}>
                  <p>
                    {advantage.text}
                  </p>
                </div>
              </div>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
};

export default Section5;

import React from 'react';

const Frame = ({ image, text }) => (
  <div className="col-md-4">
    <div className="frame">
      <div className="fram-img">
        <img src={image} alt="Advantage" />
      </div>
      <div className="frame-text">
        <p>{text}</p>
      </div>
    </div>
  </div>
);

const Section5 = ({styles}) => {
  const advantages = [
    {
      image: "https://cdn.motion.ac.in/ssp/img/neet-rank-predictor/frame-1.png",
      text: "Helps you understand where you stand in the NEET competition.",
    },
    {
      image: "https://cdn.motion.ac.in/ssp/img/neet-rank-predictor/frame-2.png",
      text: "The expected NEET rank of the candidate will be significatory of the overall performance in the entrance exam.",
    },
    {
      image: "https://cdn.motion.ac.in/ssp/img/neet-rank-predictor/frame-3.png",
      text: "After knowing the NEET rank through predictor, candidates can make a list of MBBS/BDS colleges for admission based on previous years’ trends.",
    },
  ];

  

  return (
    <section className={styles.section_5}>
      <div className="container">
        <h2>Advantage of NEET 2025 Rank Predictor</h2>
        <div className="row pt-3">
          {advantages.map((advantage, index) => (
            <Frame key={index} image={advantage.image} text={advantage.text} />
          ))}
        </div>
      </div>
    </section>
  );
};

export default Section5;

import React from "react";

const Section4 = ({ styles }) => {
  const features = [
    {
      number: "1",
      img: "https://cdn.motion.ac.in/ssp/img/kota-coaching-latest-img/choose-2.png",
      details: "18+ Years of teaching experience",
      reverse: false
    },
    {
      number: "2",
      img: "https://cdn.motion.ac.in/ssp/img/kota-coaching-latest-img/choose-1.png",
      details: "Doubt solving facilities with quick response time",
      reverse: true
    },
    {
      number: "3",
      img: "https://cdn.motion.ac.in/ssp/img/kota-coaching-latest-img/choose-3.png",
      details: "Regular communication with parents & students",
      reverse: false
    },
    {
      number: "4",
      img: "https://cdn.motion.ac.in/ssp/img/kota-coaching-latest-img/choose-4.png",
      details: "Personal mentor for guidance and counselling",
      reverse: true
    },
    {
      number: "5",
      img: "https://cdn.motion.ac.in/ssp/img/kota-coaching-latest-img/choose-5.png",
      details: "Provides online & offline batches",
      reverse: false
    },
    {
      number: "6",
      img: "https://cdn.motion.ac.in/ssp/img/kota-coaching-latest-img/choose-6.png",
      details: "Well researched & comprehensive study material",
      reverse: true
    }
  ];

  return (
    <section className={styles.section_3}>
      <div className="container">
        <h3>Why Choose Motion?</h3>
        <div className="row">
          {features.map((feature, index) => (
            <div key={index} className="col-lg-2 col-md-4">
              <div className={`${styles.why_choose} ${feature.reverse ? styles.why_row : ""}`}>
                {!feature.reverse && <p className={styles.number}>{feature.number}</p>}
                <div className={styles.why_chose_img}>
                  <img src={feature.img} alt="" className={styles.vector} />
                </div>
                <p className={styles.details}>{feature.details}</p>
                {feature.reverse && <p className={styles.number}>{feature.number}</p>}
              </div>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
};

export default Section4;
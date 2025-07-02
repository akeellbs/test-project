import React from "react";

const Section3 = ({ styles }) => {
  const batches = [
    {
      img: "https://cdn.motion.ac.in/ssp/img/kota-coaching-latest-img/benefit-3.png",
      title: "Nurture Batch",
      target: "Targetting JEE/NEET",
      description: "For 10th to 11th moving students"
    },
    {
      img: "https://cdn.motion.ac.in/ssp/img/kota-coaching-latest-img/benefit-2.png",
      title: "Enthuse Batch",
      target: "Targetting JEE/NEET",
      description: "For 11th to 12th moving students"
    },
    {
      img: "https://cdn.motion.ac.in/ssp/img/kota-coaching-latest-img/benefit-1.png",
      title: "Dropper Batch",
      target: "Targetting JEE/NEET",
      description: "For 12th to 13th moving students"
    }
  ];

  return (
    <section className={styles.section_2}>
      <div className="container">
        <h3 className={styles.title}>Upcoming Batches For JEE/NEET</h3>
        <div className="row">
          {batches.map((batch, index) => (
            <div key={index} className="col-lg-4 col-md-6">
              <div className={styles.batch}>
                <img src={batch.img} alt={batch.title} className={styles.batch_img} />
                <p className={styles.nurture}>{batch.title}</p>
                <p className={styles.targett}>{batch.target}</p>
                <p className={styles.for_student}>{batch.description}</p>
                <a href="#" className={styles.export}>
                  EXPLORE
                  <img src="https://cdn.motion.ac.in/ssp/img/kota-coaching-latest-img/Vector.png" alt="Explore" className={styles.vector} />
                </a>
              </div>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
};

export default Section3;

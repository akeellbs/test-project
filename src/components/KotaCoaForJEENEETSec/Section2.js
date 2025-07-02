import React from "react";

const Section2 = ({styles}) => {


  return (
    <>
    <section className={styles.section_1}>
        <div className="container">
            <h3>What Makes Motion Unique?</h3>
            <div className="row">
                <div className={`col-md-7 ${styles.whatmake}`}>
                    <div className={styles.whatmake_left}>
                        <p className={styles.para}>Motion Education has been nurturing students growth for over 18 years. As one of the leading coaching institutes for NEET, IIT JEE (Main + Advanced), KVPY & Olympiads, we have a proven legacy of guiding students towards selection & success through structured learning programs and with experienced mentors walking by our side at every step of the journey.</p>
                        <p className={styles.para}>With the goal of becoming Kota’s leading education service provider, Motion is committed to helping students excel in college and university entrance exams, contributing to the nation by nurturing future engineers and doctors.</p>
                    </div>
                </div>
                <div className="col-md-5">
                    <div className={styles.whatmake_right}>
                        <img src="https://cdn.motion.ac.in/ssp/img/kota-coaching-latest-img/motion-building.png" alt="cuet-board" className={styles.motion_building}/>
                    </div>

                </div>
            </div>
        </div>
    </section>
    </>
  );
};

export default Section2;

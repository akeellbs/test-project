import React from 'react';

const Section1 = ({styles}) => (
    <section className={styles.section_1}>
        <div className="container-fluid">
            <div className="row justify-content-center">
                <div className="col-lg-12">
                    <div className={styles.jee_rank}>
                        <h1>JEE Main Rank Predictor 2025</h1>
                        <p>Please input your JEE Main 2025 Marks to know your predictive rank in JEE Main 2025 Exam</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
);

export default Section1;

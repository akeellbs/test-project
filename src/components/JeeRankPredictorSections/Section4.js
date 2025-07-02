import React from 'react';

const Section4 = ({styles}) => {
  return (
    <section className={`${styles.section_4} py-8`}>
      <div className="container mx-auto px-4">
        <div className="row">
          <div className="col-md-12 text-center">
            <h2 className="text-3xl font-bold mb-6">
              Reasons to Choose Motion's JEE Main Rank Predictor
            </h2>
            <p className="text-lg">
              Our state-of-the-art tool employs advanced algorithms and current data to offer accurate predictions.
            </p>
            <p className="text-lg font-semibold mb-4">Here's why students and parents rely on us:</p>
            <ul className="text-left space-y-4 list-disc list-inside">
              <li>
                <strong>Accuracy:</strong> Our JEE Main rank predictor utilizes recent JEE Main exam data, cutoff ranks,
                and historical trends for precise outcomes.
              </li>
              <li>
                <strong>Extensive Database:</strong> We maintain a comprehensive database of engineering colleges
                nationwide, including esteemed institutions like IITs, NITs, IIITs, and more.
              </li>
              <li>
                <strong>User-Friendly Interface:</strong> Using our tool is simple. Just input your JEE Main
                marks/percentile, and let our predictor handle the rest.
              </li>
              <li>
                <strong>Regular Updates:</strong> We consistently update our tool to incorporate the latest admission
                data, ensuring you receive the most up-to-date information available.
              </li>
            </ul>
          </div>
        </div>
      </div>
    </section>
  );
};

export default Section4;

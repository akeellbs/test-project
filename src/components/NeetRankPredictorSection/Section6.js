import React from 'react';

const Section6 = ({styles}) => {
  const qualifyingMarks = [
    { category: "Unreserved", marks: "50 Percentile" },
    { category: "SC / ST / OBC / Reserved-PH", marks: "40 Percentile" },
    { category: "Unreserved-PH", marks: "45 Percentile" },
  ];

  return (
    <section className={styles.section_6}>
      <div className="container">
        <h4>Category-wise NEET Qualifying Marks</h4>
        <div className="table-responsive">
          <table className="table table-bordered">
            <thead>
              <tr className={styles.tr_head}>
                <th width="50%">Category</th>
                <th width="50%">NEET Qualifying Marks</th>
              </tr>
            </thead>
            <tbody>
              {qualifyingMarks.map((item, index) => (
                <tr key={index} className={index % 2 === 0 ? "tr-data" : ""}>
                  <td>{item.category}</td>
                  <td>{item.marks}</td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>
      </div>
    </section>
  );
};

export default Section6;

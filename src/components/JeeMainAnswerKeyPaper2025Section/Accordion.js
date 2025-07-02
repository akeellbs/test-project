import React, { useState } from "react";

const mockData = [
  {
    title: "JEE MAIN 2025 (April Attempt) Answer Key & Solutions",
    entries: [
      {
        date: "April-2025",
        shift: "Shift 1",
        time: "9:00 AM - 12:00 PM",
        subjects: [{ link: null }, { link: null }, { link: null }],
      },
      {
        date: "April-2025",
        shift: "Shift 2",
        time: "3:00 PM - 6:00 PM",
        subjects: [{ link: null }, { link: null }, { link: null }],
      },
      {
        date: "April-2025",
        shift: "Shift 1",
        time: "9:00 AM - 12:00 PM",
        subjects: [{ link: null }, { link: null }, { link: null }],
      },
      {
        date: "April-2025",
        shift: "Shift 2",
        time: "3:00 PM - 6:00 PM",
        subjects: [{ link: null }, { link: null }, { link: null }],
      },
      {
        date: "April-2025",
        shift: "Shift 1",
        time: "9:00 AM - 12:00 PM",
        subjects: [{ link: null }, { link: null }, { link: null }],
      },
      {
        date: "April-2025",
        shift: "Shift 2",
        time: "3:00 PM - 6:00 PM",
        subjects: [{ link: null }, { link: null }, { link: null }],
      },
      {
        date: "April-2025",
        shift: "Shift 1",
        time: "9:00 AM - 12:00 PM",
        subjects: [{ link: null }, { link: null }, { link: null }],
      },
      {
        date: "April-2025",
        shift: "Shift 2",
        time: "3:00 PM - 6:00 PM",
        subjects: [{ link: null }, { link: null }, { link: null }],
      },
      {
        date: "April-2025",
        shift: "Shift 1",
        time: "9:00 AM - 12:00 PM",
        subjects: [{ link: null }, { link: null }, { link: null }],
      },
      {
        date: "April-2025",
        shift: "Shift 2",
        time: "3:00 PM - 6:00 PM",
        subjects: [{ link: null }, { link: null }, { link: null }],
      },
      {
        date: "April-2025",
        shift: "Shift 1",
        time: "9:00 AM - 12:00 PM",
        subjects: [{ link: null }, { link: null }, { link: null }],
      },
      {
        date: "April-2025",
        shift: "Shift 2",
        time: "3:00 PM - 6:00 PM",
        subjects: [{ link: null }, { link: null }, { link: null }],
      },
    ],
  },
];

const Accordion = ({styleacc}) => {
  const [activeIndex, setActiveIndex] = useState(null);

  const toggleAccordion = (index) => {
    setActiveIndex(activeIndex === index ? null : index);
  };

  return (
    <div>
      {mockData.map((section, index) => (
        <div key={index} style={{ marginBottom: "40px" }}>
          <button className={styleacc.accordion} onClick={() => toggleAccordion(index)}>
            {section.title}
            <span className="plusMinus">
              {activeIndex === index ? "-" : "+"}
            </span>
          </button>
          {activeIndex === index && (
            <div
              className={`panel ${styleacc.accordionContent}`}
              style={{ padding: "0 1px" }}
            >
              <div className="textwidget">
                <div className="table-responsive">
                  <table
                    className="table table-bordered table-striped table-sm table-condensed"
                    style={{ border: "1px solid #ccc" }}
                    width="100%"
                    cellSpacing="0"
                    cellPadding="0"
                  >
                    <tbody>
                      <tr>
                        <td rowSpan="2" width="20%" className="w12">
                          Date
                        </td>
                        <td rowSpan="2" width="20%" className="w13">
                          Shift
                        </td>
                        <td colSpan="3">Paper with Solutions (English)</td>
                      </tr>
                      <tr>
                        <td>Physics</td>
                        <td>Chemistry</td>
                        <td>Maths</td>
                      </tr>
                      {section.entries.map((entry, idx) => (
                        <tr key={idx}>
                          {idx % 2 === 0 && (
                            <td
                              rowSpan="2"
                              style={{
                                textAlign: "center",
                                verticalAlign: "middle",
                              }}
                            >
                              {entry.date}
                            </td>
                          )}
                          <td align="center">
                            {entry.shift} <br /> ({entry.time})
                          </td>
                          {entry.subjects.map((subject, subIdx) => (
                            <td align="center" key={subIdx}>
                              {subject.link ? (
                                <a
                                  href={subject.link}
                                  target="_blank"
                                  rel="noopener noreferrer"
                                  className={`btn ${styleacc.btn_template_main}`}
                                >
                                  <i className="fa fa-download"></i> Download
                                </a>
                              ) : (
                                <p className={`btn ${styleacc.btn_template_main}`}>
                                  Coming soon
                                </p>
                              )}
                            </td>
                          ))}
                        </tr>
                      ))}
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          )}
        </div>
      ))}
    </div>
  );
};

export default Accordion;

import React from "react";
const scheduleData = [
  {
    date: "04-January-2025",
    shifts: [
      {
        name: "Shift 1",
        time: "9:00 AM - 12:00 PM",
        subjects: [
          { link: null }, // Physics
          { link: null }, // Chemistry
          { link: null }, // Maths
        ],
      },
      {
        name: "Shift 2",
        time: "3:00 PM - 6:00 PM",
        subjects: [
          { link: null }, // Physics
          { link: null }, // Chemistry
          { link: null }, // Maths
        ],
      },
    ],
  },
  {
    date: "05-January-2025",
    shifts: [
      {
        name: "Shift 1",
        time: "9:00 AM - 12:00 PM",
        subjects: [
          { link: null }, // Physics
          { link: null }, // Chemistry
          { link: null }, // Maths
        ],
      },
      {
        name: "Shift 2",
        time: "3:00 PM - 6:00 PM",
        subjects: [
          { link: null }, // Physics
          { link: null }, // Chemistry
          { link: null }, // Maths
        ],
      },
    ],
  },
  {
    date: "06-January-2025",
    shifts: [
      {
        name: "Shift 1",
        time: "9:00 AM - 12:00 PM",
        subjects: [
          { link: null }, // Physics
          { link: null }, // Chemistry
          { link: null }, // Maths
        ],
      },
      {
        name: "Shift 2",
        time: "3:00 PM - 6:00 PM",
        subjects: [
          { link: null }, // Physics
          { link: null }, // Chemistry
          { link: null }, // Maths
        ],
      },
    ],
  },
  {
    date: "08-January-2025",
    shifts: [
      {
        name: "Shift 1",
        time: "9:00 AM - 12:00 PM",
        subjects: [
          { link: null }, // Physics
          { link: null }, // Chemistry
          { link: null }, // Maths
        ],
      },
      {
        name: "Shift 2",
        time: "3:00 PM - 6:00 PM",
        subjects: [
          { link: null }, // Physics
          { link: null }, // Chemistry
          { link: null }, // Maths
        ],
      },
    ],
  },
  {
    date: "09-January-2025",
    shifts: [
      {
        name: "Shift 1",
        time: "9:00 AM - 12:00 PM",
        subjects: [
          { link: null }, // Physics
          { link: null }, // Chemistry
          { link: null }, // Maths
        ],
      },
      {
        name: "Shift 2",
        time: "3:00 PM - 6:00 PM",
        subjects: [
          { link: null }, // Physics
          { link: null }, // Chemistry
          { link: null }, // Maths
        ],
      },
    ],
  },
];

const ExamSchedule = ({styleexam}) => {
  return (
    <div className="table-responsive">
      <table
        className="table table-bordered table-stripped table-sm table-condensed"
        style={{ border: "1px solid #ccc", width: "100%" }}
        cellSpacing="0"
        cellPadding="0"
      >
        <thead>
          <tr>
            <th width="20%" rowSpan="2" align="center">
              <strong>Date</strong>
            </th>
            <th rowSpan="2" align="center">
              <strong>Shift</strong>
            </th>
            <th colSpan="3" align="center">
              <strong>Paper with Solutions (English)</strong>
            </th>
          </tr>
          <tr>
            <th align="center">
              <strong>Physics</strong>
            </th>
            <th align="center">
              <strong>Chemistry</strong>
            </th>
            <th align="center">
              <strong>Maths</strong>
            </th>
          </tr>
        </thead>
        <tbody>
          {scheduleData.map((dateData, dateIndex) => (
            <>
              {dateData.shifts.map((shift, shiftIndex) => (
                <tr key={`${dateIndex}-${shiftIndex}`}>
                  {shiftIndex === 0 && (
                    <td
                      rowSpan={dateData.shifts.length}
                      style={{
                        textAlign: "center",
                        verticalAlign: "middle",
                      }}
                    >
                      {dateData.date}
                    </td>
                  )}
                  <td align="center">
                    {shift.name} <br />({shift.time})
                  </td>
                  {shift.subjects.map((subject, subjectIndex) => (
                    <td align="center" key={subjectIndex}>
                      {subject.link ? (
                        <a
                          target="_blank"
                          rel="noopener noreferrer"
                          href={subject.link}
                          className={`btn ${styleexam.btn_template_main}`}
                        >
                          <i className="fa fa-download"></i> Download
                        </a>
                      ) : (
                        <p className={`btn ${styleexam.btn_template_main}`}>Coming soon</p>
                      )}
                    </td>
                  ))}
                </tr>
              ))}
            </>
          ))}
        </tbody>
      </table>
    </div>
  );
};

export default ExamSchedule;

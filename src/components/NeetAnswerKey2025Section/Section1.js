import React, { useState } from "react";
import ModalForm from "./ModalForm";
const Section1 = ({ styles }) => {
  const [data] = useState([
    {
      paperCode: "T-5",
      questionPaperUrl:
        "https://cdn.motion.ac.in/ssp/neet-answer-2025/T5-NEET-2025-ANSWER-KEY-WITH-Question-Paper.pdf",
      subjects: [
        { name: "Physics", url: "" },
        { name: "Chemistry", url: "" },
        { name: "Zoology", url: "" },
        { name: "Botany", url: "" },
      ],
    },
  ]);
  const answerKeys = [
    {
      code: "Q-1",
      label: "NEET 2025 Answer Key Paper Code Q-1",
      url: "/downloads/q1.pdf",
    },
    {
      code: "Q-2",
      label: "NEET 2025 Answer Key Paper Code Q-2",
      url: "/downloads/q2.pdf",
    },
    {
      code: "Q-3",
      label: "NEET 2025 Answer Key Paper Code Q-3",
      url: "/downloads/q3.pdf",
    },
    {
      code: "Q-4",
      label: "NEET 2025 Answer Key Paper Code Q-4",
      url: "/downloads/q4.pdf",
    },
    {
      code: "Q-5",
      label: "NEET 2025 Answer Key Paper Code Q-5",
      url: "/downloads/q5.pdf",
    },
    {
      code: "Q-6",
      label: "NEET 2025 Answer Key Paper Code Q-6",
      url: "/downloads/q6.pdf",
    },
    {
      code: "R-1",
      label: "NEET 2025 Answer Key Paper Code R-1",
      url: "/downloads/r1.pdf",
    },
    {
      code: "R-2",
      label: "NEET 2025 Answer Key Paper Code R-2",
      url: "/downloads/r2.pdf",
    },
    {
      code: "R-3",
      label: "NEET 2025 Answer Key Paper Code R-3",
      url: "/downloads/r3.pdf",
    },
    {
      code: "R-4",
      label: "NEET 2025 Answer Key Paper Code R-4",
      url: "/downloads/r4.pdf",
    },
    {
      code: "R-5",
      label: "NEET 2025 Answer Key Paper Code R-5",
      url: "/downloads/r5.pdf",
    },
    {
      code: "R-6",
      label: "NEET 2025 Answer Key Paper Code R-6",
      url: "/downloads/r6.pdf",
    },
    {
      code: "S-1",
      label: "NEET 2025 Answer Key Paper Code S-1",
      url: "/downloads/s1.pdf",
    },
    {
      code: "S-2",
      label: "NEET 2025 Answer Key Paper Code S-2",
      url: "/downloads/s2.pdf",
    },
    {
      code: "S-3",
      label: "NEET 2025 Answer Key Paper Code S-3",
      url: "/downloads/s3.pdf",
    },
    {
      code: "S-4",
      label: "NEET 2025 Answer Key Paper Code S-4",
      url: "/downloads/s4.pdf",
    },
    {
      code: "S-5",
      label: "NEET 2025 Answer Key Paper Code S-5",
      url: "/downloads/s5.pdf",
    },
    {
      code: "S-6",
      label: "NEET 2025 Answer Key Paper Code S-6",
      url: "/downloads/s6.pdf",
    },
    {
      code: "T-1",
      label: "NEET 2025 Answer Key Paper Code T-1",
      url: "/downloads/t1.pdf",
    },
    {
      code: "T-2",
      label: "NEET 2025 Answer Key Paper Code T-2",
      url: "/downloads/t2.pdf",
    },
    {
      code: "T-3",
      label: "NEET 2025 Answer Key Paper Code T-3",
      url: "/downloads/t3.pdf",
    },
    {
      code: "T-4",
      label: "NEET 2025 Answer Key Paper Code T-4",
      url: "/downloads/t4.pdf",
    },
    {
      code: "T-5",
      label: "NEET 2025 Answer Key Paper Code T-5",
      url: "/downloads/t5.pdf",
    },
    {
      code: "T-6",
      label: "NEET 2025 Answer Key Paper Code T-6",
      url: "/downloads/t6.pdf",
    },
  ];
  const links = [
    {
      href: "https://uat.motion.ac.in/neet-result/",
      imgSrc:
        "https://uat.motion.ac.in/storage/website/result_answer_image/1714743902551830.png",
      altText: "NEET Result",
    },
    {
      href: "https://uat.motion.ac.in/courses/12th-pass-neet/",
      imgSrc:
        "https://uat.motion.ac.in/storage/website/result_answer_image/1714825161595204.jpg",
      altText: "12th Pass NEET",
    },
    {
      href: "",
      imgSrc:
        "https://uat.motion.ac.in/storage/website/result_answer_image/1714220756785743.jpg",
      altText: "Another Image",
    },
  ];
  return (
    <>
      <ModalForm />
      <section className={`${styles.best_selection_ratio} ${styles.fontname}`}>
        <div className={styles.custom_container}>
          <div className={styles.study_centers_div}>
            <div className="row">
              <div className={`col-md-8 ${styles.inner_content}`}>
                <h1 className="text-left">
                  NEET 2025 Answer Key and Detailed Solution
                </h1>
                <p className="text-left">
                  NEET Answer Key 2025 - Motion Education, Kota's Top NEET
                  coaching institute will release NEET 2025 answer key after a few
                  hours of exam conduct. Our Top NEET faculty team design the most
                  accurate & authentic NEET Answer Key & Paper solutions. With the
                  help of our NEET 2025 Answer Key & paper solutions, students are
                  able to check their NEET score.
                </p>

                <h5 className="text-left" style={{ fontWeight: 500 }}>
                  <strong>NEET 2025 Paper with Answer</strong>
                </h5>

                {data.map((item, index) => (
                  <div
                    className={`table-responsive ${styles.section1_table}`}
                    style={{ marginTop: "20px" }}
                    key={index}
                  >
                    <table className="table table-bordered table-striped table-sm table-condensed">
                      <tbody>
                        <tr>
                          <th
                            style={{
                              textAlign: "center",
                              verticalAlign: "middle",
                              background: "#b50303",
                              color: "#fff",
                            }}
                            rowSpan="2"
                          >
                            NEET 2025 Paper Code {item.paperCode}
                          </th>
                          <th className="text-center" width="15%">
                            Question Paper with Answer Key
                          </th>
                          <th className="text-center" width="15%">
                            Physics
                          </th>
                          <th className="text-center" width="15%">
                            Chemistry
                          </th>
                          <th className="text-center" width="15%">
                            Zoology
                          </th>
                          <th className="text-center" width="15%">
                            Botany
                          </th>
                        </tr>
                        <tr>
                          <td className="text-center">
                            <a
                              href={item.questionPaperUrl}
                              target="_blank"
                              className={`btn ${styles.btn_template_main} ${styles.downloadPdf}`}
                              data-pcode="question_paper_with_answer_key"
                              data-id="question_paper_with_answer_key"
                              download
                            >
                              <i className="fa fa-download"></i> Download
                            </a>
                          </td>
                          {item.subjects.map((subject, idx) => (
                            <td key={idx} className="text-center">
                              <a
                                href={subject.url}
                                target="_blank"
                                className={`btn ${styles.btn_template_main} ${styles.downloadPdf}`}
                                data-id={subject.name.toLowerCase()}
                                data-pcode={subject.name.toLowerCase()}
                                download
                              >
                                <i className="fa fa-download"></i> Download
                              </a>
                            </td>
                          ))}
                        </tr>
                      </tbody>
                    </table>
                  </div>
                ))}

                <div className={styles.download_pdf}>
                  <div className="row">
                    <div className={`col-md-6 ${styles.rank_predictor1}`}>
                      <h4>
                        <strong>Answer Key For All Sets </strong>
                      </h4>
                    </div>
                    <div className={`col-md-6 ${styles.load_pdf}`}>
                      <a
                        href="javascript:void(0)"
                        target="_blank"
                        className={`btn ${styles.btn_template_main} ${styles.downloadPdf}`}
                        style={{
                          fontSize: "25px",
                          fontWeight: "bold",
                          padding: "5px 30px",
                        }}
                        data-id="answer_key_for_all_set"
                        data-pcode="answer_key_for_all_set"
                        data-url=""
                      >
                        <i className="fa fa-download"></i> Download
                      </a>
                    </div>
                  </div>
                </div>
                <div
                  className={`${styles.heading} ${styles.sec_heading} text-center`}
                  style={{ marginTop: "20px", marginBottom: "20px" }}
                >
                  <h3>NEET 2025 Question Paper with Answer Key</h3>
                </div>

                <div
                  className={`${styles.heading} ${styles.sec_heading} text-center`}
                  style={{ marginTop: "20px", marginBottom: "20px" }}
                >
                  <a
                    href="https://motion.ac.in/neet-rank-predictor/"
                    className="rank-predictor0"
                    style={{ fontSize: "20px", color: "#fff" }}
                  >
                    To know your expected{" "}
                    <span style={{ color: "#fff", fontWeight: "bold" }}>
                      RANK & COLLEGE
                    </span>{" "}
                    click here!!
                  </a>
                </div>
                <div
                  className={`${styles.heading} ${styles.sec_heading} text-center`}
                  style={{ marginTop: "20px", marginBottom: "20px" }}
                >
                  <a
                    href="https://motion.ac.in/neet-marks-calculator/"
                    className="rank-predictor0"
                    style={{ fontSize: "20px", color: "#fff" }}
                  >
                    To know your expected{" "}
                    <span style={{ color: "#fff", fontWeight: "bold" }}>
                      NEET 2025 marks
                    </span>{" "}
                    click on the marks calculator!!{" "}
                  </a>
                </div>

                <div className={styles.sec2_table}>
                  <table
                    className="table table-bordered table-striped table-sm table-condensed"
                    style={{ border: "1px solid #ccc", width: "100%" }}
                    cellSpacing="0"
                    cellPadding="0"
                  >
                    <thead>
                      <tr>
                        <th className="w25" style={{ textAlign: "center" }}>
                          Paper Code
                        </th>
                        <th className="w25" style={{ textAlign: "center" }}>
                          Answer Key
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      {answerKeys.map((item) => (
                        <tr key={item.code}>
                          <td className="text-center">
                            <strong>{item.label}</strong>
                          </td>
                          <td className="text-center">
                            <a
                              href={item.url}
                              target="_blank"
                              className={`btn ${styles.btn_template_main} ${styles.downloadPdf}`}
                              data-id="all"
                              data-pcode={item.code}
                              data-url={item.url}
                            >
                              <i className="fa fa-download"></i> Download
                            </a>
                          </td>
                        </tr>
                      ))}
                    </tbody>
                  </table>
                </div>

                <div
                  className={`${styles.heading} ${styles.sec_heading} text-center`}
                  style={{ marginTop: "50px", marginBottom: "20px" }}
                >
                  <h3>NEET 2025 EXAM PAPER VIDEO SOLUTION</h3>
                </div>

                <div className="row" style={{ marginBottom: "30px" }}>
                  <div className={`col-sm-4 ${styles.section3}`}>
                    <h4
                      style={{
                        lineHeight: "34px",
                        fontSize: "20px",
                        marginTop: "0px",
                      }}
                      className="text-center"
                    >
                      Watch NEET 2025 Answer Key on YouTube
                    </h4>
                  </div>

                  <div className="col-sm-8">
                    <p className="text-center">
                      <iframe
                        src="https://www.youtube.com/embed/GOrW_E6zrec?si=0lkafbO4uaMoCKS7&autoplay=1&loop=1&mute=1"
                        frameborder="0"
                        allowfullscreen
                        className="fastest"
                        style={{
                          width: "550px",
                          height: "309px",
                          left: "0px",
                          top: "3px",
                        }}
                      ></iframe>
                    </p>

                  </div>
                </div>

                <h3>
                  Question papers are the pioneer of curiosity & answer keys are
                  the pioneer of confidence and happiness!!!
                </h3>

                <p>
                  So, students, Motion Education Pvt Ltd is here with all that you
                  need to appear for difficult NEET examinations you will get all
                  the details about the NEET answer key 2025, question papers, the
                  solution to the questions, and the OMRs.
                </p>

                <p>
                  The NTA releases the NEET answer key at its official site. In
                  the 4th week of May this year, NEET 2025 answer key is expected
                  to be released. The answer keys are released by many institutes
                  soon after the NEET exam gets over & they receive the question
                  papers. The answer key covers all the answers to the questions
                  asked in the exam. The NEET answer key helps students to get an
                  idea of their probable scores before the official announcement
                  of their results. The students get an idea of qualifying for the
                  NEET UG Test.
                </p>

                <h3 className="text-left" style={{ marginTop: "20px" }}>
                  NEET ANSWER KEY 2025 BY NTA
                </h3>
                <p className="text-left">
                  The National testing agency will release the NEET 2025 answer
                  key on the official website neet.nta.nic.in. The link for
                  downloading the answer key will be present on this site after
                  availability. The answer key will be available there on the site
                  in PDF format.
                </p>

                <h3 className="text-left">
                  Downloading the NEET 2025 Answer Key
                </h3>
                <p className="text-left">
                  For the candidates who appeared in the NEET 2025 Exam, the
                  following are the steps to download the NEET answer key 2025:
                </p>
                <ol className="text-left" style={{ marginLeft: "20px" }}>
                  <li>Visit the official website,neet.nta.nic.in</li>
                  <li>Click the download answer key tab</li>
                  <li>NEET 2025 answer keys PDF get displayed</li>
                  <li>
                    Choose the respective PDF and click the download button.
                  </li>
                  <li>The Answer key PDF gets downloaded.</li>
                </ol>

                <h4>Calculating the score using NEET 2025 answer key</h4>
                <p className="text-left">
                  To get an idea of their score, a candidate can take the help of
                  the answer key. For this, the candidate should follow the given
                  steps:
                </p>

                <ul style={{ marginLeft: "20px" }}>
                  <li>
                    Check your answers by comparing the answer key with your OMR
                    sheet.
                  </li>
                  <li>
                    Candidates must check the question paper code and match it
                    with the answer key before tallying to avoid inappropriate
                    results.
                  </li>
                  <li>
                    Candidates must count the number of correctly and incorrectly
                    answered questions.
                  </li>
                  <li>Calculate the number of unanswered questions also.</li>
                </ul>
                <br />

                <h4 className={styles.top_heading}>Marking scheme for NEET 2025</h4>
                <p className="text-left">
                  Correct Answer +4 <br />
                  Incorrect Answer -1 <br />
                  Unanswered 0 <br />
                  More than one response 0 <br />
                  Use the following formula for calculating your scores; <br />
                  <i>
                    NEET 2025 score = [4*(Number of Correct Answers)] – [1*(Number
                    of Incorrect Answers)]
                  </i>
                </p>

                <h4 className={styles.top_heading}>
                  What is 'Challenging the NEET answer key'?
                </h4>
                <p>
                  Challenging the answer key means, After the NEET answer key is
                  released and if any of the candidates find that the answer he
                  has correctly answered is incorrect or vice versa, he is allowed
                  to challenge the same. NDA gives the right to the students.
                </p>

                <h4 className={styles.top_heading}>
                  NEET 2025 answer key Challenging Fees
                </h4>
                <p>
                  Candidates are supposed to pay a 200rs fee for each answer to
                  challenge in the NEET answer key 2025. This fee will be
                  non-refundable in any situation.
                </p>

                <h4 className={styles.top_heading}>
                  Steps for challenging the official NEET 2025 answer key
                </h4>
                <ol style={{ marginLeft: "20px" }}>
                  <li>
                    Go to the link that will take you to the page challenging the
                    answer key.
                  </li>
                  <li>Enter the Application number and password to log in.</li>
                  <li>
                    Click the Key Challenge option and select the Test Booklet
                    Code that they want to challenge in the NEET 2025 answer key.
                  </li>
                  <li>Select the question to be challenged.</li>
                  <li>
                    After this, choose the answer that is correct according to
                    you.
                  </li>
                  <li>Click the Submit button.</li>
                  <li>
                    After clicking the submit button, the payment gateway gets
                    displayed.
                  </li>
                  <li>Complete the payment.</li>
                  <li>The transaction details get displayed on the screen.</li>
                  <li>
                    With the success of the transaction, the procedure gets
                    completed.
                  </li>
                </ol>

                <h4 className={styles.top_heading}>
                  Challenging the NEET OMR response sheet 2025
                </h4>
                <p>
                  Along with the NEET answer key, NDA releases the NEET OMR sheet.
                  OMR response sheet is the scanned copy of the candidate's answer
                  key that contains the answer given by the candidates. If they
                  feel that the response sheet has any discrepancy, they can
                  challenge it. The candidates will be given two days for the
                  same.
                </p>

                <h4 className={styles.top_heading}>
                  Steps to challenge OMR response sheet of NEET 2025
                </h4>
                <ol style={{ marginLeft: "20px" }}>
                  <li>
                    Click the link provided for challenging the OMR response
                    sheet.
                  </li>
                  <li>Enter your application number and password to log in.</li>
                  <li>Click the OMR Challenge tab.</li>
                  <li>
                    The displayed page will display two options:
                    <ul>
                      <li>View your OMR Answer Sheet</li>
                      <li>Challenge OMR sheet</li>
                    </ul>
                  </li>
                  <li>
                    To challenge the OMR answer sheet, make the payment of 200rs.
                  </li>
                </ol>

                <h4 className={styles.top_heading}>NEET Previous Year's Answer Keys</h4>
                <p>
                  As the NEET UG 2025 answer key is not yet released, candidates
                  can check the last year's answer key with the help of the
                  following codes: <br />
                  <br />
                  <a
                    href="https://motion.ac.in/neet-answer-key-solutions-2023/"
                    target="_blank"
                  >
                    NEET 2023 Answer Key and Solutions PDF Codes
                  </a>
                  <br />
                  <a
                    href="https://motion.ac.in/neet-answer-key-solutions-2022/"
                    target="_blank"
                  >
                    NEET 2022 Answer Key and Solutions PDF Codes
                  </a>
                  <br />
                  <a
                    href="https://motion.ac.in/neet-answer-key-solutions/"
                    target="_blank"
                  >
                    NEET 2021 Answer Key and Solutions PDF Codes
                  </a>{" "}
                  <br />
                  <a
                    href="https://motion.ac.in/neet-answer-key-solutions/"
                    target="_blank"
                  >
                    NEET 2020 Answer Key and Solutions PDF Codes
                  </a>{" "}
                  <br />
                  <a
                    href="https://motion.ac.in/neet-2019-answer-key-solutions/"
                    target="_blank"
                  >
                    NEET 2019 Answer Key and Solutions PDF Codes
                  </a>{" "}
                  <br />
                  <a
                    href="https://motion.ac.in/neet-answer-key-solutions/"
                    target="_blank"
                  >
                    NEET 2018 Answer Key and Solutions PDF Codes
                  </a>{" "}
                  <br />
                  <br />
                  Motion team wishes All the best for your future endeavours, and
                  in between any queries & help, contact us anytime!!
                  <br />
                  <br />
                  We have our dedicated help desk to help you in every possible
                  manner.
                </p>
              </div>

              <div class="col-md-4">
                <div className="row">
                  {links.map((item, index) => (
                    <div className="col-md-12" key={index}>
                      <a
                        href={item.href}
                        target="_blank"
                        rel="noopener noreferrer"
                      >
                        <img
                          src={item.imgSrc}
                          alt={item.altText}
                          className="img-fluid about_img"
                          style={{ marginBottom: "20px" }}
                        />
                      </a>
                    </div>
                  ))}
                </div>
              </div>
            </div>
          </div>
          <p className="text-left">
            NEET 2025 Answer Key | NTA NEET Solutions | NTA NEET Paper Analysis |
            NTA NEET Question Paper with Solutions | NTA NEET 2025 | NEET Video
            Solutions | NEET 2025 | NEET 2025 Question Paper with Solutions PDF |
            NEET 2025 Answer key with Solutions | NEET 2025 Question Paper
            Analysis | NEET 2025 Answer Key PDF
          </p>
        </div>
      </section>
    </>

  );
};

export default Section1;

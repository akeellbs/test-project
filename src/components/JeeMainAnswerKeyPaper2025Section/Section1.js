import React from "react";
import Accordion from "./Accordion";
import ExamSchedule from "./ExamSchedule ";
import ModalForm from "./ModalForm";
const Section1 = ({styles}) => {
  // Example usage

  const imageLinks = [
    {
      href: "https://motion.ac.in/most/",
      src: "https://cdn.motion.ac.in/ssp/img/images/side_img_most.jpg",
      alt: "MOST",
    },
    {
      href: "https://uat.motion.ac.in/courses/12th-pass-neet/",
      src: "https://motion.ac.in/website/result_image/jee_adavanced_result_2023_lp_mobile.png",
      alt: "12th Pass NEET Course",
    },
    {
      href: "",
      src: "https://motion.ac.in/website/result_image/jee_adavanced_result_2023_lp_mobile.png",
      alt: "Motion Banner",
    },
  ];

  const contentData = [
    {
      title: "JEE Main 2025 Tips & Tricks",
      buttonText: "Coming soon",
      buttonLink: "",
      centerText: true,
    },
    {
      title: "",
      links: [
        {
          text: "JEE MAIN 2025 Paper Analysis PDF",
          href: "#",
          target: "_blank",
          onClick: () => {
            // Add analytics or custom behavior here if needed
            console.log("Clicked JEE MAIN 2025 Paper Analysis PDF");
          },
        },
        {
          text: "JEE MAIN 2025 Paper Analysis Video",
          href: "#video_analiysis",
        },
        {
          text: "JEE MAIN 2025 Video Solutions",
          href: "https://motion.ac.in/jee-main-answer-key-video-solutions-2025/",
          target: "_blank",
        },
      ],
    },
  ];

  const answerKeyDates = [
    {
      event: "JEE Main 2025 Exam Date",
      dates: ["Session 1 - To be released", "Session 2 - To be released"],
    },
    {
      event: "JEE Main provisional answer key release date",
      dates: ["Session 1 - To be released", "Session 2 - To be released"],
    },
    {
      event: "NTA JEE Main answer key challenge date",
      dates: ["Session 1 - To be released", "Session 2 - To be released"],
    },
    {
      event: "JEE Main 2025 final answer key date",
      dates: ["Session 1 - To be released", "Session 2 - To be released"],
    },
  ];

  const markingScheme = [
    { response: "Correct response", marking: "Four marks awarded" },
    { response: "Incorrect response", marking: "One mark deducted" },
    { response: "No answer", marking: "No marks" },
    { response: "Marked for review", marking: "No Marks" },
  ];

  const stepsToDownloadAnswerKey = [
    "Visit the official JEE Main website: jeemain.nta.nic.in for the year 2025.",
    "Locate and click on the link for JEE Mains 2025 answer key.",
    "Provide your JEE Main application number and date of birth as requested.",
    "Download the NTA JEE Main answer key PDF file for your convenience.",
  ];

  const stepsToChallengeAnswerKey = [
    "Visit the official NTA website at jeemain.nta.nic.in.",
    "Click on the link for 'challenges regarding answer key.",
    "Log in using your application number and password.",
    "View the question ID and the ID with the correct option for both Paper 1 and Paper 2.",
    "Challenge the question by selecting one or more IDs.",
    "Click on 'Save your claim' and proceed.",
    "Provide supporting documents in PDF format.",
    "Pay the processing fee of Rs 200 per question via credit card, debit card, or net banking.",
  ];

  return (
    <>
      <ModalForm/>
      <section className={styles.best_selection_ratio}>
        <div className={styles.custom_container}>
          <div className={styles.study_centers_div}>
            <h1 className="text-center">
              JEE MAIN 2025 Answer Key &amp; Solutions (January Attempt)
            </h1>
            <p className="text-center">
              JEE Main 2025 answer key is be ready by top Kota Coaching JEE
              faculties of Motion which will be accessible for download.
              Further, we will provide video answers for JEE Main January 2025
              and Analysis of this Computer Based Test is additionally
              accessible.
            </p>
            <p className="text-center">
              Through this, students will be able to comprehend the JEE Main
              2025 question paper better by seeing the video solutions. By using
              the Answer Key, students can also calculate their tentative JEE
              Main 2025 score.
            </p>

            <div className="row" style={{ marginBottom: "30px" }}>
              <div className="col-sm-4 text-center">
                <a
                  target="_blank"
                  className={`btn ${styles.btn_template_main}`}
                  style={{ marginBottom: "10px" }}
                >
                  {" "}
                  JEE MAIN January 2025 Expected Questions{" "}
                </a>
              </div>
              <div className="col-sm-4 text-center">
                <a
                  target="_blank"
                  className={`btn ${styles.btn_template_main}`}
                  style={{ marginBottom: "10px" }}
                >
                  {" "}
                  FAQs JEE (Main) 2025{" "}
                </a>
              </div>
              <div className="col-sm-4 text-center">
                <a
                  target="_blank"
                  className={`btn ${styles.btn_template_main}`}
                  style={{ marginBottom: "10px" }}
                >
                  {" "}
                  SYLLABUS for JEE Main-2025{" "}
                </a>
              </div>
            </div>

            <div className="row">
              <div className="col-md-8 inner_content">
                <h3 className="text-left inner_heading ">
                  JEE MAIN 2025 (January Attempt) Answer Key &amp; Solutions
                </h3>
                <p className="text-left">
                  Download the Answer Key &amp; Solutions of the JEE MAIN 2025
                  (January Attempt) Paper here.
                </p>

                <h2
                  className="text-left"
                  style={{
                    background: "#7a827a",
                    color: "#fff",
                    fontSize: "16px",
                    fontWeight: "bold",
                    lineHeight: "25px",
                  }}
                >
                  JEE MAIN 2025 Paper with Answer Key &amp; Solutions
                </h2>
                <ExamSchedule styleexam={styles} />
                <Accordion styleacc={styles} />
                <hr style={{ margin: "40px 0px" }} />
                <div className="row">
                  {contentData.map((item, index) => (
                    <div
                      className={`col-md-${item.centerText ? "6" : "6"}`}
                      key={index}
                    >
                      {item.title && (
                        <h4 style={{ textAlign: "center" }}>{item.title}</h4>
                      )}

                      {item.buttonText && item.centerText && (
                        <center>
                          <p className={`btn ${styles.btn_template_main}`}>
                            {item.buttonText}
                          </p>
                        </center>
                      )}

                      {item.links &&
                        item.links.map((link, linkIndex) => (
                          <React.Fragment key={linkIndex}>
                            <a
                              href={link.href}
                              target={link.target || "_self"}
                              className={`btn ${styles.btn_template_main} ${styles.vidsln} ${styles.newbtns}`}
                              onClick={link.onClick}
                              rel="noopener noreferrer"
                            >
                              {link.text}
                            </a>
                            <br />
                            <br />
                          </React.Fragment>
                        ))}
                    </div>
                  ))}
                </div>
                <h5 className="text-left" style={{ marginTop: "20px" }}>
                  All you Need to know about JEE MAIN 2025
                </h5>
                <hr />

                <h2 className="text-left" style={{ marginTop: "40px" }}>
                  JEE Main Answer Key 2025
                </h2>
                <p>
                  Candidates had the opportunity to forecast their likely scores
                  by utilizing the JEE Main 2025 answer key. Nevertheless, the
                  ultimate scores were disclosed concurrently with the JEE Main
                  2025 results. Aspirants were granted the privilege to contest
                  the accuracy of the JEE Main answer key 2025 for January
                  Session. When raising objections during this challenge phase,
                  applicants were required to remit a fee of Rs. 200 for each
                  question they wished to dispute. In addition to the answer
                  key, the National Testing Agency (NTA) also made available a
                  response sheet on the official website. The final answer key
                  for
                  <a href="https://motion.ac.in/jee-main-exam/" target="_blank">
                    JEE Main 2025
                  </a>
                  contains the correct responses to the questions posed in the
                  JEE Mains 2025 examination. NTA independently issued an IIT
                  JEE Main 2025 answer key for each of the sessions. Aspiring
                  candidates can procure the official JEE Mains 2025 answer keys
                  for the January and January sessions either from this page or
                  the official website.
                </p>
                <p>
                  For comprehensive details regarding the retrieval and
                  objection procedure for the
                  <a
                    href="https://motion.ac.in/jee-main-answer-key-paper-solutions-2025/"
                    target="_blank"
                  >
                    JEE Main answer key 2025
                  </a>
                  , please consult the article below.
                </p>

                <h2 className="text-left" style={{ marginTop: "40px" }}>
                  JEE Main Answer Key 2025 Release Date
                </h2>
                <p>
                  The National Testing Agency (NTA) has unveiled the official
                  answer key for session 1 of JEE Main 2025. Individuals seeking
                  to obtain the JEE Main answer key 2025 PDF can access it on
                  the NTA's official website, jeemain.nta.nic.in. Further
                  information regarding the release date of the JEE Mains answer
                  key 2025 is provided below.
                </p>

                <h3 className="text-left" style={{ marginTop: "40px" }}>
                  JEE Main 2025 Answer Key Release Date
                </h3>
                <table className="table table-bordered">
                  <thead>
                    <tr>
                      <th
                        style={{ textAlign: "left", verticalAlign: "middle" }}
                      >
                        Events
                      </th>
                      <th
                        style={{ textAlign: "left", verticalAlign: "middle" }}
                      >
                        JEE Main Dates
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    {answerKeyDates.map((row, index) => (
                      <tr key={index}>
                        <td
                          style={{ textAlign: "left", verticalAlign: "middle" }}
                        >
                          {row.event}
                        </td>
                        <td style={{ textAlign: "left" }}>
                          {row.dates.map((date, idx) => (
                            <div key={idx}>{date}</div>
                          ))}
                        </td>
                      </tr>
                    ))}
                  </tbody>
                </table>
                <h2 style={{ marginTop: "40px" }}>
                  How to download NTA JEE Main Answer key 2025?
                </h2>
                <p>
                  Below are the step-by-step instructions for downloading the
                  JEE Main 2025 answer key in PDF format:
                </p>
                <ul>
                  {stepsToDownloadAnswerKey.map((step, index) => (
                    <li key={index}>● {step}</li>
                  ))}
                </ul>
                <p>
                  Once you have downloaded the JEE Mains 2025 answer key, you
                  can compare it with your responses to estimate your probable
                  score. Candidates were permitted to challenge any responses in
                  the NTA JEE Main 2025 answer key that they believed to be
                  incorrect, while presenting supporting evidence for their
                  claims. These objections will be reviewed by experts, and
                  adjustments may be made to the final JEE Main answer key for
                  2025 accordingly.
                </p>

                <h2 style={{ marginTop: "40px" }}>
                  How to challenge JEE Main 2025 Answer Key?
                </h2>
                <p>
                  Upon obtaining the provisional NTA JEE Main answer key for
                  session 1 of 2025, candidates have the opportunity to raise
                  objections against any answers they believe are incorrect. To
                  initiate the objection process, candidates should make a note
                  of the question ID, the provided answer from the JEE Main 2025
                  answer key, and the correct answer. They must also submit a
                  processing fee of Rs 200 for each question they wish to
                  challenge. The objection process involves the following steps:
                </p>
                <ul>
                  {stepsToChallengeAnswerKey.map((step, index) => (
                    <li key={index}>● {step}</li>
                  ))}
                </ul>

                <h2 style={{ marginTop: "40px" }}>
                  JEE Main Answer Key 2025- How to calculate probable scores
                </h2>
                <p>
                  Candidates participating in the engineering entrance
                  examination can estimate their potential scores by utilizing
                  the official JEE Mains answer key for 2025. Given the familiar
                  <a href="https://motion.ac.in/blog/jee-main-exam-pattern/">
                    {" "}
                    JEE Main 2025 exam pattern
                  </a>
                  , which includes negative marking for incorrect responses and
                  the allocation of marks for correct answers, the table below
                  illustrates the marking scheme that should be consulted:
                </p>

                <h3 style={{ marginTop: "40px" }}>
                  Marking Scheme of JEE Main 2025
                </h3>
                <table className="table table-bordered">
                  <thead>
                    <tr>
                      <th>Type of Response</th>
                      <th>Marking Scheme</th>
                    </tr>
                  </thead>
                  <tbody>
                    {markingScheme.map((scheme, index) => (
                      <tr key={index}>
                        <td>{scheme.response}</td>
                        <td>{scheme.marking}</td>
                      </tr>
                    ))}
                  </tbody>
                </table>

                <p>
                  <b>
                    Therefore, to compute their likely scores in the JEE Main
                    2025 exam, candidates should apply the following formula:
                  </b>
                </p>
                <p>
                  Probable Score = (Number of correct answers x 4) - (Number of
                  incorrect answers) It's important to note that this calculated
                  score is consistently referred to as "probable" because the
                  exam authorities retain the right to invalidate questions or
                  modify correct responses in the JEE Main 2025 answer key.
                  Consequently, the calculated score may fluctuate in accordance
                  with any alterations in the JEE Mains scoring system and the
                  ultimate
                  <a href="https://motion.ac.in/blog/jee-main-result/">
                    {" "}
                    JEE Main result
                  </a>
                  .
                </p>
                {/* JEE Main Response Sheet 2025 */}
                <h2 className="text-left" style={{ marginTop: "40px" }}>
                  JEE Main Response Sheet 2025
                </h2>
                <p>
                  The NTA has made available the JEE Mains response sheets of
                  candidates in conjunction with the answer key and question
                  papers. To access their response sheets for JEE Mains 2025,
                  candidates can visit the official website at{" "}
                  <a href="https://jeemain.nta.nic.in">jeemain.nta.nic.in</a>{" "}
                  and enter their application number and date of birth.
                </p>
                <p>
                  The JEE Main candidate response sheet contains the accurate
                  answers to the questions posed in the examination. Candidates
                  can utilize these response sheets to estimate their
                  anticipated scores in the exam even before the official
                  results are announced.
                </p>

                {/* JEE Main 2025 Exam Pattern */}
                <h2 className="text-left" style={{ marginTop: "40px" }}>
                  JEE Main 2025 Exam Pattern
                </h2>
                <div className="card-block" style={{ padding: "20px" }}>
                  <p>
                    Exam Pattern has been revised of JEE Main 2025, considering
                    the syllabus reduction by state boards and CBSE. Physics,
                    Maths and Chemistry will now have 30 questions each. All
                    these subjects will have two sections. 20 MCQs in section A
                    and 10 Numerical value answer based questions in section B.
                    In section B candidate must have to attempt five questions
                    out of 10.
                  </p>
                  <ul style={{ marginBottom: "15px", listStyle: "none" }}>
                    <li>
                      <i
                        className="fa fa-check"
                        style={{ color: "#ffcf32" }}
                      ></i>{" "}
                      JEE Main 2025 will be conducted in 13 languages this is
                      the another major change introduced in JEE Main Paper
                      Pattern.
                    </li>
                    <li>
                      <i
                        className="fa fa-check"
                        style={{ color: "#ffcf32" }}
                      ></i>{" "}
                      Paper 1 will be covering MCQs and numerical-value type
                      questions from all the three subjects with total marks of
                      300 and it will be computer based.
                    </li>
                    <li>
                      <i
                        className="fa fa-check"
                        style={{ color: "#ffcf32" }}
                      ></i>
                      Mathematics and aptitude sections will be common in B.
                      Arch and B. Planning papers and third section of drawing
                      or planning based respectively.
                    </li>
                  </ul>
                </div>

                {/* How to fill the JEE Main 2025 form */}
                <h2 className="text-left" style={{ marginTop: "20px" }}>
                  How to fill the JEE Main 2025 form
                </h2>
                <div className="card-block" style={{ padding: "20px" }}>
                  <p>
                    Steps to fill the application form of JEE Main 2025 is given
                    below. How to fill the application form can be summarised in
                    the following simple steps.
                  </p>
                  <ul style={{ marginBottom: "15px", listStyle: "none" }}>
                    <li>
                      <i
                        className="fa fa-check"
                        style={{ color: "#ffcf32" }}
                      ></i>{" "}
                      Visit NTA/JEE Main website-{" "}
                      <a href="https://jeemain.nta.nic.in">
                        jeemain.nta.nic.in
                      </a>
                    </li>
                    <li>
                      <i
                        className="fa fa-check"
                        style={{ color: "#ffcf32" }}
                      ></i>{" "}
                      Login to fill details in application form
                    </li>
                    <li>
                      <i
                        className="fa fa-check"
                        style={{ color: "#ffcf32" }}
                      ></i>{" "}
                      Upload the photo and signature along with Class 12 mark
                      sheet
                    </li>
                    <li>
                      <i
                        className="fa fa-check"
                        style={{ color: "#ffcf32" }}
                      ></i>{" "}
                      Verify all the details carefully.
                    </li>
                    <li>
                      <i
                        className="fa fa-check"
                        style={{ color: "#ffcf32" }}
                      ></i>{" "}
                      Fee payment
                    </li>
                    <li>
                      <i
                        className="fa fa-check"
                        style={{ color: "#ffcf32" }}
                      ></i>{" "}
                      Print out of the JEE Main confirmation page
                    </li>
                    <li>
                      <i
                        className="fa fa-check"
                        style={{ color: "#ffcf32" }}
                      ></i>{" "}
                      Keep the confirmation page of JEE Main 2025 safe for
                      further reference
                    </li>
                  </ul>
                </div>
              </div>

              <div className="col-md-4">
                <div className="row">
                  {imageLinks.map((item, index) => (
                    <div className="col-md-12" key={index}>
                      <a
                        href={item.href}
                        target="_blank"
                        rel="noopener noreferrer"
                      >
                        <img
                          src={item.src}
                          alt={item.alt}
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
        </div>
      </section>
    </>
  );
};

export default Section1;

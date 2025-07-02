import React, { useState } from "react";
import SliderComponent from "./SliderComponent ";
import axios from "axios";

const Section2 = ({ styles }) => {
  // State for form data
  const [formData, setFormData] = useState({
    stname: "",
    classs: "",
    stmob: "",
    stemail: "",
    marks: "",
    fromwhere: "NEET Rank Predictor",
    utm_source: "google",
    utm_medium: "google",
    utm_campaign: "google",
    utm_term: "google",
    utm_content: "google",
  });

  const [isSubmitDisabled, setSubmitDisabled] = useState(false);

  // Handle input change
  const handleChange = (e) => {
    const { name, value } = e.target;
    setFormData((prevData) => ({
      ...prevData,
      [name]: value,
    }));
    validateForm();
  };

  // Validate form for enabling the submit button
  const validateForm = () => {
    const { stname, classs, stmob, stemail, marks } = formData;
    const isValid =
      stname.trim() &&
      classs &&
      /^[6-9][0-9]{9}$/.test(stmob) &&
      /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(stemail) &&
      marks.trim();
    setSubmitDisabled(!isValid);
  };

  const [isSubmitted, setIsSubmitted] = useState(false);
  const [error, setError] = useState(null);

  // Handle form submission
  const handleSubmit = async (e) => {
    e.preventDefault();
    setError(null);

    try {
      const response = await fetch("https://node.motion.ac.in/insertData", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(formData),
      });

      if (!response.ok) {
        throw new Error("Failed to submit form");
      }

      const data = await response.json();
      console.log("Form Submitted Successfully:", data);
      setIsSubmitted(true);
    } catch (err) {
      console.error("Error submitting form:", err);
      setError("Submission failed. Please try again.");
    }
  };


  return (
    <section className={styles.section_2}>
      <div className="container">
        <div className="row">
          <div className="col-lg-8 col-md-6 col-sm-6 ">
            <div className={styles.rank_form}>
              {isSubmitted ? (
                <div className={styles.thank_you_message}>
                  <h2 className={styles.thankyou_title}><img src="https://cdn.motion.ac.in/ssp/img/amrit/right-icon.png" alt="Best Coaching Institute for NEET, IIT-JEE, Motion Kota"/>Thank You!</h2>
                  <p className={styles.thankyou_text}>Your form has been submitted successfully. We will get in touch with you soon!</p>
                </div>
              ) : (
                <form
                  id="neet_rank_landing_form_submit"
                  className={`form ${styles.rank_form_1}`}
                  onSubmit={handleSubmit}
                >
                  <h2>Motion NEET 2025 Rank Predictor</h2>
                  <input type="hidden" name="utm_source" value={formData.utm_source} />
                  <input type="hidden" name="utm_medium" value={formData.utm_medium} />
                  <input type="hidden" name="utm_campaign" value={formData.utm_campaign} />
                  <input type="hidden" name="utm_term" value={formData.utm_term} />
                  <input type="hidden" name="utm_content" value={formData.utm_content} />
                  <input type="hidden" name="from_where" value={formData.fromwhere} />
                  <input type="hidden" name="contect_source" value={formData.contect_source} />
                  <div className="form-group">
                    <input
                      type="text"
                      id="inputTextBox"
                      className="form-control"
                      name="stname"
                      placeholder="Enter Your Name"
                      required
                      value={formData.stname}
                      onChange={handleChange}
                    />
                  </div>

                  <div className="form-group">
                    <select
                      name="classs"
                      id="classs"
                      className="form-control"
                      required
                      value={formData.classs}
                      onChange={handleChange}
                    >
                      <option value="">Class</option>
                      <option value="12">12th</option>
                      <option value="13">12th Pass</option>
                    </select>
                  </div>

                  <div className="form-group">
                    <input
                      type="tel"
                      className="form-control"
                      placeholder="Mobile Number"
                      name="stmob"
                      pattern="[6-9]{1}[0-9]{9}"
                      maxLength="10"
                      required
                      value={formData.stmob}
                      onChange={handleChange}
                    />
                  </div>

                  <div className="form-group">
                    <input
                      type="email"
                      name="stemail"
                      id="stemail"
                      className="form-control"
                      placeholder="Enter Your Email Id"
                      required
                      value={formData.stemail}
                      onChange={handleChange}
                    />
                  </div>

                  <div className="form-group">
                    <input
                      type="text"
                      className="form-control"
                      name="marks"
                      placeholder="Total Marks"
                      required
                      value={formData.marks}
                      onChange={handleChange}
                    />
                  </div>

                  <div className="form-group subbtn">
                    <button
                      type="submit"
                      className={styles.btnsub}
                    // disabled={isSubmitDisabled}
                    >
                      Submit Details
                    </button>
                  </div>
                </form>
              )}
            </div>
          </div>

          <div className={`col-lg-4 col-md-6 col-sm-6 ${styles.news_slidecnt}`}>
            <SliderComponent />

          </div>
        </div>
      </div>
    </section>
  );
};

export default Section2;

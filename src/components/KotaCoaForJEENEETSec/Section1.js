import React, { useState } from "react";

const Section1 = ({ styles }) => {

  const [formData, setFormData] = useState({
    stname: "",
    classs: "",
    course: "",
    stmob: "",
    stemail: "",
    time_to_call: "",
    fromwhere: "Kota Coaching For JEE NEET",
    utm_source: "google",
    utm_medium: "google",
    utm_campaign: "google",
    utm_term: "google",
    utm_content: "google",

  });

  const [isSubmitted, setIsSubmitted] = useState(false);
  const [error, setError] = useState(null);

  const handleChange = (e) => {
    const { name, value } = e.target;
    setFormData((prevData) => ({ ...prevData, [name]: value }));
    console.log(name, value);
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    setError(null);
    console.log("Form Data:", formData);

    try {
      const response = await fetch("https://node.motion.ac.in/insertData", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(formData),
      });

      console.log("Response Status:", response.status);
      const responseText = await response.text(); // Read raw response
      console.log("Raw Response:", responseText);

      if (!response.ok) {
        throw new Error(`Server error: ${response.status}`);
      }

      const data = JSON.parse(responseText); // Convert text to JSON
      console.log("Form Submitted Successfully:", data);
      setIsSubmitted(true);
    } catch (err) {
      console.error("Error submitting form:", err);
      setError("Submission failed. Please try again.");
    }
  };


  const isNumber = (e) => {
    const charCode = e.which || e.keyCode;
    if (charCode < 48 || charCode > 57) {
      e.preventDefault();
    }
  };

  return (
    <div className={`${styles.section_header}`}>
      <div className="container-fluid">
        <div className="row">
          <div className={`col-lg-8 col-md-6 col-sm-12 col-12`}>
            <div>
              <div className={styles.title_bar}>
                <h1>Get <span>Upto 100%</span> Scholarship</h1>
                <p className={styles.prep}>On JEE & NEET Courses</p>
                <p className={styles.for_class}>For students moving to classes 11th, 12th and 13th</p>
              </div>
            </div>
          </div>
          <div className={`col-lg-4 col-md-6 col-sm-12 col-12`}>
            <div className={styles.regss_form}>

              {isSubmitted ? (
                <div className={styles.thank_you_message}>
                  <img src="https://cdn.motion.ac.in/ssp/img/amrit/right-icon.png" alt="Best Coaching Institute for NEET, IIT-JEE, Motion Kota" />
                  <h2 className={styles.thankyou_title}>Thank You!</h2>
                  <p className={styles.thankyou_text}>Your form has been submitted successfully. We will get in touch with you soon!</p>
                </div>
              ) : (
                <>
                  <h2>Start Your Preparation Now!</h2>
                  <form className="form" onSubmit={handleSubmit}>
                    <input type="hidden" name="utm_source" value={formData.utm_source} />
                    <input type="hidden" name="utm_medium" value={formData.utm_medium} />
                    <input type="hidden" name="utm_campaign" value={formData.utm_campaign} />
                    <input type="hidden" name="utm_term" value={formData.utm_term} />
                    <input type="hidden" name="utm_content" value={formData.utm_content} />
                    <input type="hidden" name="from_where" value={formData.fromwhere} />
                    <input type="hidden" name="contect_source" value={formData.contect_source} />


                    <div className="col-12 form-group">
                      <label className="form-label">Your Name</label>
                      <input
                        type="text"
                        className="form-control"
                        name="stname"
                        value={formData.stname}
                        onChange={handleChange}
                        placeholder="Enter your Name"
                        required
                      />
                    </div>
                    <div className="col-lg-12">
                      <div className="row">
                        <div className="col-md-6 form-group">
                          <label className="form-label">Class</label>
                          <select
                            name="classs"
                            className="form-select form-control"
                            value={formData.classs}
                            onChange={handleChange}
                            required
                          >
                            <option disabled value="">
                              Choose Your Class
                            </option>
                            <option value="11th">11th</option>
                            <option value="12th">12th</option>
                            <option value="12th pass">12th Pass</option>
                          </select>
                        </div>

                        <div className="col-md-6 form-group">
                          <label className="form-label">Stream</label>
                          <select
                            name="course"
                            className="form-select form-control"
                            value={formData.course}
                            onChange={handleChange}
                            required
                          >
                            <option disabled value="">
                              Select Stream
                            </option>
                            <option value="NEET">NEET</option>
                            <option value="JEE">JEE</option>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div className="col-12 form-group">
                      <label className="form-label">Mobile Number</label>
                      <input
                        type="text"
                        className="form-control"
                        name="stmob"
                        value={formData.stmob}
                        onChange={handleChange}
                        placeholder="Enter your Mobile Number"
                        required
                        pattern="[6-9]{1}[0-9]{9}"
                        maxLength="10"
                        onKeyPress={isNumber}
                      />
                    </div>
                    <div className="col-12 form-group">
                      <label className="form-label">Email Id</label>
                      <input
                        type="email"
                        className="form-control"
                        name="stemail"
                        value={formData.stemail}
                        onChange={handleChange}
                        placeholder="Enter your Email Id"
                        required
                      />
                    </div>

                    <div className="col-lg-12 col-md-12 form-group">
                      <label className="form-label">Best Time to Call You</label>
                      <select
                        name="time_to_call"
                        className="form-select form-control"
                        value={formData.time_to_call}
                        onChange={handleChange}
                        required
                      >
                        <option disabled value="">
                          Best Time to Call You
                        </option>
                        {[
                          "9AM - 10AM",
                          "10AM - 11AM",
                          "11AM - 12PM",
                          "12PM - 1PM",
                          "1PM - 2PM",
                          "2PM - 3PM",
                          "3PM - 4PM",
                          "4PM - 5PM",
                          "5PM - 6PM",
                          "6PM - 7PM",
                          "7PM - 8PM",
                          "8PM - 9PM",
                        ].map((slot) => (
                          <option key={slot} value={slot}>
                            {slot}
                          </option>
                        ))}
                      </select>
                    </div>

                    <div className="col-12">
                      <button type="submit" id="formSubmitBtn" className={`btn form-control ${styles.btn_submit}`}>
                        Submit
                      </button>
                    </div>
                  </form>

                </>
              )}
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Section1;

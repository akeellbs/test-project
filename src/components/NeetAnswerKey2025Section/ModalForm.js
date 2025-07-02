import React, { useState, useEffect } from "react";
import modalstyles from './ModalForm.module.css'
const ModalForm = () => {
  const [formData, setFormData] = useState({
    stname: "",
    stemail: "",
    stmob: "",
    classs: "",
    fromwhere: 'NEET Answer Key Solutions 2025',
    utm_source: "google",
    utm_medium: "google",
    utm_campaign: "google",
    utm_term: "google",
    utm_content: "google",
  });

  const [modalVisible, setModalVisible] = useState(false);
  const [otpFieldVisible, setOtpFieldVisible] = useState(false);
  const [utmData, setUtmData] = useState({
    source: "",
    medium: "",
    campaign: "",
    term: "",
    content: "",
  });

  // Handle form data changes
  const handleChange = (e) => {
    setFormData({
      ...formData,
      [e.target.name]: e.target.value,
    });
  };

  // Handle close modal
  const closeModal = () => {
    setModalVisible(false); // Hide modal when close button is clicked
  };

  // Handle modal visibility on window load
  useEffect(() => {
    const handleWindowLoad = () => {
      setModalVisible(true); // Show modal when window is loaded
    };

    window.addEventListener("load", handleWindowLoad); // Listen for window load

    return () => {
      window.removeEventListener("load", handleWindowLoad); // Clean up on unmount
    };
  }, []);

  const [isSubmitted, setIsSubmitted] = useState(false);
  const [error, setError] = useState(null);

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
    <>

      {modalVisible && (
        <div
          id="myModal_e"
          className="modal fontname"
          style={
            isSubmitted
              ? {
                display: "none", // Make sure the modal is displayed
              }
              : {
                backgroundColor: "transparent",
                margin: "150px auto",
                display: "block", // Make sure the modal is displayed
              }
          }
        >
          <div className="modal-dialog">
            <div className="modal-content">
              <div>
                <button
                  type="button"
                  className="close"
                  onClick={closeModal} // Close the modal when the button is clicked
                  aria-label="Close"
                  style={{
                    position: "absolute",
                    top: "10px",
                    right: "10px",
                    background: "transparent",
                    border: "none",
                    fontSize: "1.5em",
                    color: "#000",
                  }}
                >
                  &times; {/* Close icon */}
                </button>
                <p
                  className="modal-title text-center"
                  style={{ marginTop: "10px", fontSize: "16px" }}
                >
                  Fill in the Details Below for Important Updates
                </p>
                <h4
                  className="modal-title text-center"
                  style={{ fontWeight: "bold", color: "#0a387c" }}
                >
                  NEET (UG) 2025
                </h4>
                <h5 className="text-center" style={{ fontWeight: "bold" }}>
                  Answer Key & Solutions
                </h5>
              </div>

              <div className="modal-body">
                <form
                  className="form"
                  id="landing_form_submit"
                  onSubmit={handleSubmit}
                >
                  {/* Hidden Inputs */}
                  <input
                    type="hidden"
                    name="utm_source"
                    value={utmData.source}
                  />
                  <input
                    type="hidden"
                    name="utm_medium"
                    value={utmData.medium}
                  />
                  <input
                    type="hidden"
                    name="utm_campaign"
                    value={utmData.campaign}
                  />
                  <input type="hidden" name="utm_term" value={utmData.term} />
                  <input
                    type="hidden"
                    name="utm_content"
                    value={utmData.content}
                  />
                  <input
                    type="hidden"
                    name="from_where"
                    value="Neet Answer Key"
                  />
                  <input
                    type="hidden"
                    name="contect_source"
                    value="Study Center"
                  />
                  <input
                    type="hidden"
                    name="thankyou"
                    id="thankyou"
                    value="neet-answer-key-solutions-2025"
                  />

                  {/* Name Input */}
                  <div className="form-group">
                    <input
                      type="text"
                      className="form-control"
                      name="stname"
                      value={formData.stname}
                      onChange={handleChange}
                      required
                      placeholder="Name"
                      onInput={(e) =>
                      (e.target.value = e.target.value.replace(
                        /[^a-z ]/gi,
                        ""
                      ))
                      }
                    />
                  </div>

                  {/* Email Input */}
                  <div className="form-group">
                    <input
                      type="email"
                      className="form-control"
                      name="stemail"
                      value={formData.stemail}
                      onChange={handleChange}
                      required
                      placeholder="Enter Email"
                    />
                  </div>

                  {/* Mobile Input */}
                  <div className="form-group buttonIn">
                    <input
                      type="tel"
                      className="form-control"
                      placeholder="Mobile Number"
                      name="stmob"
                      value={formData.stmob}
                      onChange={handleChange}
                      pattern="[6-9]{1}[0-9]{9}"
                      maxLength="10"
                      required
                      onKeyPress={(e) => /^[0-9]$/.test(e.key)}
                    />
                    <div className="mobile_error validation-error"></div>
                  </div>

                 

                  {/* Class Select */}
                  <div className="form-group">
                    <select
                      className="form-control"
                      name="classs"
                      value={formData.classs}
                      onChange={handleChange}
                      required
                    >
                      <option value="">Select Class</option>
                      <option value="12">12th</option>
                      <option value="13">12th Pass</option>
                    </select>
                  </div>

                  {/* Submit Button */}
                  <input
                    type="submit"
                    name="submit"
                    className={`form-control ${modalstyles.lfh_btn}`}
                  />
                </form>
              </div>
            </div>
          </div>
        </div>
      )}
    </>
  );
};

export default ModalForm;

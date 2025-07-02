import React, { useState } from 'react';

const Section1 = ({ styles }) => {
    const [formData, setFormData] = useState({
        stname: '',
        stmob: '',
        stemail: '',
        roll_number: '',
        extra_detail: '',
        fromwhere: 'NEET Marks Calculator',
        utm_source: "google",
        utm_medium: "google",
        utm_campaign: "google",
        utm_term: "google",
        utm_content: "google",
    });

    const [showOtpField, setShowOtpField] = useState(false);

    const handleChange = (e) => {
        const { name, value } = e.target;
        setFormData({
            ...formData,
            [name]: value,
        });
    };
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


    const isNumber = (value) => /^[0-9]*$/.test(value);
    const isNameValid = (value) => /^[a-zA-Z, ]*$/.test(value);

    return (
        <section className={styles.section_header}>
            <div className="container">
                <div className="row justify-content-center">
                    <div className="col-lg-5 col-md-6">
                        <div className={styles.regss_form}>
                            {isSubmitted ? (
                                <div className={styles.thank_neet_message}>
                                    <h3 className={styles.thankyou_title}><img src="https://cdn.motion.ac.in/ssp/img/amrit/right-icon.png" alt="Best Coaching Institute for NEET, IIT-JEE, Motion Kota"/>Thank You!</h3>
                                    <p className={styles.thankyou_text}>Your form has been submitted successfully. We will get in touch with you soon!</p>
                                </div>
                            ) : (
                                <form className="form" method="post" onSubmit={handleSubmit}>
                                    <h2>Calculate Your NEET Marks</h2>
                                    <input type="hidden" name="_token" value="K4D12AjgnNtI98I5bannIYpibY1FJXEYlCzJK9u2" />
                                    <input type="hidden" name="utm_source" value={formData.utm_source} />
                                    <input type="hidden" name="utm_medium" value={formData.utm_medium} />
                                    <input type="hidden" name="utm_campaign" value={formData.utm_campaign} />
                                    <input type="hidden" name="utm_term" value={formData.utm_term} />
                                    <input type="hidden" name="utm_content" value={formData.utm_content} />
                                   
                                    <input type="hidden" name="from_where" value={formData.fromwhere} />
                                    <input type="hidden" name="contect_source" value={formData.contect_source} />
                                    

                                    <div className="form-group">
                                        <label>Your Name</label>
                                        <input
                                            type="text"
                                            placeholder="Enter Student’s Name"
                                            name="stname"
                                            className="form-control"
                                            value={formData.stname}
                                            onChange={(e) => isNameValid(e.target.value) && handleChange(e)}
                                            required
                                        />
                                    </div>

                                    <div className="form-group">
                                        <label>Mobile Number</label>
                                        <input
                                            type="tel"
                                            placeholder="Enter your Mobile Number"
                                            name="stmob"
                                            className="form-control"
                                            value={formData.stmob}
                                            onChange={(e) => isNumber(e.target.value) && handleChange(e)}
                                            pattern="[6-9]{1}[0-9]{9}"
                                            maxLength="10"
                                            required
                                        />
                                    </div>

                                    <div className="form-group">
                                        <label>Email Id</label>
                                        <input
                                            type="email"
                                            placeholder="Enter your Email Id"
                                            name="stemail"
                                            className="form-control"
                                            value={formData.stemail}
                                            onChange={handleChange}
                                            required
                                        />
                                    </div>

                                    <div className="form-group">
                                        <label>Enter NEET 2024 Roll No.</label>
                                        <input
                                            type="text"
                                            placeholder="Enter Roll No."
                                            name="roll_number"
                                            className="form-control"
                                            value={formData.roll_number}
                                            onChange={(e) => isNumber(e.target.value) && handleChange(e)}
                                            required
                                        />
                                    </div>

                                    <div className="form-group">
                                        <label>Select Paper Code</label>
                                        <select
                                            className="form-control"
                                            name="extra_detail"
                                            value={formData.extra_detail}
                                            onChange={handleChange}
                                        >
                                            <option value="">Select Paper Code</option>
                                            {['E1', 'E2', 'E3', 'E4', 'E5', 'E6', 'F1', 'F2', 'F3', 'F4', 'F5', 'F6', 'G1', 'G2', 'G3', 'G4', 'G5', 'G6', 'H1', 'H2', 'H3', 'H4', 'H5', 'H6'].map(
                                                (code, index) => (
                                                    <option key={index} value={code}>
                                                        {code}
                                                    </option>
                                                )
                                            )}
                                        </select>
                                    </div>

                                    <div className="form-group">
                                        <button type="submit" className={`btn ${styles.btn_submit} form-control`}>
                                            Calculate Now!
                                        </button>
                                    </div>
                                </form>
                            )}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    );
};

export default Section1;

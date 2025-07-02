import React, { useState } from 'react';
import SliderComponent from './SliderComponent ';
import axios from 'axios';

const Section2 = ({ styles }) => {
    const [formData, setFormData] = useState({
        marks: '',
        stname: '',
        classs: '',
        stmob: '',
        stemail: '',
        extra_detail: '',
        fromwhere: 'JEE Main Rank Predictor',
        utm_source: "google",
        utm_medium: "google",
        utm_campaign: "google",
        utm_term: "google",
        utm_content: "google",
    });

    const handleChange = (e) => {
        setFormData({ ...formData, [e.target.name]: e.target.value });
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


    return (
        <section className={styles.section_2}>
            <div className="container">
                <div className="row">
                    <div className="col-lg-8 col-md-6" >
                        {isSubmitted ? (
                            <div className={styles.thank_you_message}>
                                <h2 className={styles.thankyou_title}><img src="https://cdn.motion.ac.in/ssp/img/amrit/right-icon.png" alt="Best Coaching Institute for NEET, IIT-JEE, Motion Kota" />Thank You!</h2>
                                <p className={styles.thankyou_text}>Your form has been submitted successfully. We will get in touch with you soon!</p>
                            </div>
                        ) : (
                            <form onSubmit={handleSubmit} className={`form ${styles.rank_form_1}`}>
                                <h2>Enter Exam Details</h2>
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
                                        className="form-control"
                                        name="marks"
                                        placeholder="Total Marks"
                                        value={formData.marks}
                                        onChange={handleChange}
                                        required
                                    />
                                </div>
                                <div className="form-group">
                                    <input
                                        type="text"
                                        className="form-control"
                                        name="stname"
                                        placeholder="Enter Your Name"
                                        value={formData.stname}
                                        onChange={handleChange}
                                        required
                                    />
                                </div>
                                <div className="form-group">
                                    <select
                                        name="classs"
                                        className="form-control"
                                        value={formData.classs}
                                        onChange={handleChange}
                                        required
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
                                        name="stmob"
                                        placeholder="Mobile Number"
                                        pattern="[6-9]{1}[0-9]{9}"
                                        maxLength="10"
                                        value={formData.stmob}
                                        onChange={handleChange}
                                        required
                                    />
                                </div>
                                <div className="form-group">
                                    <input
                                        type="email"
                                        className="form-control"
                                        name="stemail"
                                        placeholder="Enter Your Email Id"
                                        value={formData.stemail}
                                        onChange={handleChange}
                                        required
                                    />
                                </div>
                                <div className="form-group">
                                    <select
                                        name="extra_detail"
                                        className="form-control"
                                        value={formData.extra_detail}
                                        onChange={handleChange}
                                        required
                                    >
                                        <option value="">Select Category</option>
                                        <option value="general">General</option>
                                        <option value="ews">EWS</option>
                                        <option value="obc">OBC</option>
                                        <option value="sc">SC</option>
                                        <option value="st">ST</option>
                                    </select>
                                </div>
                                <div className={`form-group ${styles.subbtn}`}>
                                    <button type="submit" className={styles.btnsub}>Predict Now</button>
                                </div>
                            </form>
                        )}
                    </div>
                    <div className="col-lg-4 col-md-6 myslider">
                        <SliderComponent />
                    </div>
                </div>
            </div>
        </section>
    );
};

export default Section2;

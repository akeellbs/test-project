import React from "react";
import jeerankstyles from "./JeeRankPredictor.module.css";
import Section1 from "../../components/JeeRankPredictorSections/Section1";
import Section2 from "../../components/JeeRankPredictorSections/Section2";
import Section3 from "../../components/JeeRankPredictorSections/Section3";
import Section4 from "../../components/JeeRankPredictorSections/Section4";
import Section5 from "../../components/JeeRankPredictorSections/Section5";
import Section6 from "../../components/JeeRankPredictorSections/Section6";
import Section7 from "../../components/JeeRankPredictorSections/Section7";
import Section8 from "../../components/JeeRankPredictorSections/Section8";

const JeeRankPredictor = () => {
  return (
    <div className="main">
      <Section1 styles={jeerankstyles} />
      <Section2 styles={jeerankstyles} />
      <Section3 styles={jeerankstyles} />
      <Section4 styles={jeerankstyles} />
      <Section5 styles={jeerankstyles} />
      <Section6 styles={jeerankstyles} />
      <Section7 styles={jeerankstyles} />
      <Section8 styles={jeerankstyles} />
    </div>
  );
};

export default JeeRankPredictor;

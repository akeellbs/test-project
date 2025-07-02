import React from "react";
import neetmarkstyles from "./NeetMarksCalculator.module.css";
import Section1 from "../../components/NeetMarksCalculatorSection/Section1";



const NeetRankPredictor = () => {
  return (
    <div className="main">
        <Section1 styles={neetmarkstyles}/>
    </div>
  );
};

export default NeetRankPredictor;
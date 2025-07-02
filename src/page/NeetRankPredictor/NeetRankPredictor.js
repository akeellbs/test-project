import React from "react";
import neetrankstyles from "./NeetRankPredictor.module.css";
import Section1 from "../../components/NeetRankPredictorSection/Section1";
import Section2 from "../../components/NeetRankPredictorSection/Section2";
import Section3 from "../../components/NeetRankPredictorSection/Section3";
import Section4 from "../../components/NeetRankPredictorSection/Section4";
import Section5 from "../../components/NeetRankPredictorSection/Section5";
import Section6 from "../../components/NeetRankPredictorSection/Section6";
import Section7 from "../../components/NeetRankPredictorSection/Section7";
import Section8 from "../../components/NeetRankPredictorSection/Section8";
import Section9 from "../../components/NeetRankPredictorSection/Section9";


const NeetRankPredictor = () => {
  return (
    <div className="main">
        <Section1 styles={neetrankstyles} />
        <Section2 styles={neetrankstyles}/>
        <Section3 styles={neetrankstyles}/>
        <Section4 styles={neetrankstyles}/>
        <Section5 styles={neetrankstyles}/>
        <Section6 styles={neetrankstyles}/>
        <Section7 styles={neetrankstyles}/>
        <Section8 styles={neetrankstyles}/>
        <Section9 styles={neetrankstyles}/>

    </div>
  );
};

export default NeetRankPredictor;
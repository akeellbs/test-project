import React from "react";
import kotacoachingstyles from "./KotaCoachingForJEENEET.module.css";
import Section1 from "../../components/KotaCoaForJEENEETSec/Section1";
import Section2 from "../../components/KotaCoaForJEENEETSec/Section2";
import Section3 from "../../components/KotaCoaForJEENEETSec/Section3";
import Section4 from "../../components/KotaCoaForJEENEETSec/Section4";
import Section5 from "../../components/KotaCoaForJEENEETSec/Section5";
import Section6 from "../../components/KotaCoaForJEENEETSec/Section6";

const KotaCoachingForJEENEET = () => {
  return (
    <div className="main">
      <Section1 styles={kotacoachingstyles} />
      <Section2 styles={kotacoachingstyles}  />
      <Section3 styles={kotacoachingstyles} />
      <Section4 styles={kotacoachingstyles} />
      <Section5 styles={kotacoachingstyles} />
      <Section6 styles={kotacoachingstyles} />
    </div>
  );
};

export default KotaCoachingForJEENEET;

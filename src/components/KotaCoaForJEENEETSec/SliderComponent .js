import React from "react";
import Slider from "react-slick";
import { FaArrowRight, FaArrowLeft } from "react-icons/fa"; // Import arrow icons

const testimonials = [
  {
    name: "Vaibhav Sinha",
    rank: "NEET 2023 (Rank 30)",
    message:
      "Motion played a huge role in achieving my dream of becoming a doctor. While preparing, I was really active in giving all the tests honestly and analysing the scores. It helped me analyse my weak and strong topics. With the help and guidance of the experienced faculties of Motion, I converted these weak topics into strong ones. I would like to thank all the teachers at Motion who helped me achieve my dream.",
    image:
      "https://cdn.motion.ac.in/ssp/img/testimonial/vaibhav-sinha-testimonial.png",
  },
  {
    name: "Navya Mishra",
    rank: "NEET 2023 (Rank 71)",
    message:
      "Becoming a doctor was my childhood dream, and to fulfil this dream, I came to Kota and joined Motion. Preparing with Motion really helped me; the faculties are really caring, and the advice provided by them was really helpful. Due to their advice and the schedule they helped me prepare, I was able to score 705 and reach my dream college. The personal attention by the faculties and the other facilities, like the Brahamastra test series, proved to be crucial in my preparation. Thanks a lot, Motion, for all the help.",
    image:
      "https://cdn.motion.ac.in/ssp/img/testimonial/navya-mishra-testimonial.png",
  },
  {
    name: "Palak Nishant Shah",
    rank: "NEET 2023 (Rank 94)",
    message:
      "Motion has been a very guiding and caring institute. The faculties here are highly supportive, and they help understand every student’s potential. The regularly discussed test and the doubt session play a major role in shaping the guidance and future of many children. Thank you so much, NV Sir and Motion, for the guidance and support that have been a major part of my story.",
    image:
      "https://cdn.motion.ac.in/ssp/img/testimonial/palak-nishant-shah-testimonial.png",
  },
  {
    name: "Apoorva Samota",
    rank: "JEE ADVANCED 2023 (Rank 92)",
    message:
      "Hello, my name is Apoorva Samota (Rank 92) (Udaipur) and I scored 100%ile in JEE Main 2023 and AIR 39. After JEE Main, I joined the I-Eklavya Batch of Motion, and because of that, my performance increased in my JEE Advanced as well. I attempted the test papers of Motion and analysed the mistakes that were happening in them, and I improved my marks. I also attended online classes on some topics, which helped me in inorganic and organic chemistry.",
    image:
      "https://cdn.motion.ac.in/ssp/img/testimonial/apurva-samota-testimonial.png",
  },
  {
    name: "Aaditya Sharma",
    rank: "JEE ADVANCED 2023 (Rank 118)",
    message:
      "Hello everyone I, Aaditya Sharma (Rank 118) (Saharanpur) have been a student of Motion Education, which helped me secure a good rank in JEE Main and Advanced. The guidance and exam strategy suggested by NV Sir, RRD Sir, and NS Sir, helped me a lot in cracking JEE Advanced. I owe my success to my parents and Motion Education. The study material and tests are systematically designed, which helped me in regular analysis and securing a good rank.",
    image:
      "https://cdn.motion.ac.in/ssp/img/testimonial/aaditya-sharma-testimonial.png",
  },
  {
    name: "Mayank Soni",
    rank: "JEE ADVANCED 2023 (Rank 26)",
    message:
      "Hello, I'm Mayank Soni (Rank 26) (Sikar) I took JEE Advanced in 2023. I enrolled in the online programme of Motion, and this helped me secure a good rank in JEE Advanced. The online classes in Motion and the Test Series helped a lot in my preparation, and this boosted my preparation a lot. The Test Series was created with the same pattern as the JEE Exam, which is really beneficial to me, and Motion's dedication motivated me to work hard to achieve my goal. Faculty were very supportive and cleared all my doubts. I am thankful to each & everyone.",
    image:
      "https://cdn.motion.ac.in/ssp/img/testimonial/mayank-soni-testimonial.png",
  },
  {
    name: "Rishit Agarwal",
    rank: "NEET 2022 (AIR 27)",
    message:
      "I have dreamt of becoming a Doctor since a long time & Motion has helped me pave this path of success. From providing us with the most experienced faculties, the best study materials & the mentors around me also helped throughout my journey, they kept me motivated. Utterly thankful to the team of Motion.",
    image: "https://cdn.motion.ac.in/ssp/img/testimonial/rishit_agarwal.png",
  },
  {
    name: "Kavya Gupta",
    rank: "JEE Advanced 2022 (AIR 25)",
    message:
      "IIT always felt like a dream and under the proper guidance and help of Team Motion in the form of best mentors, proper doubt solving facilities, best study material and DPP’s I am getting my dream engineering college.",
    image: "https://cdn.motion.ac.in/ssp/img/testimonial/kavya_gupta.png",
  },
];

// Custom Next Arrow
const NextArrow = ({ onClick }) => (
  <div className="slick-next" onClick={onClick}>
    <FaArrowRight />
  </div>
);

// Custom Previous Arrow
const PrevArrow = ({ onClick }) => (
  <div className="slick-prev" onClick={onClick}>
    <FaArrowLeft />
  </div>
);

const SliderComponent = () => {
  const settings = {
    dots: false,
    infinite: true,
    speed: 500,
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 3000,
    arrows: true,
    nextArrow: <NextArrow />,
    prevArrow: <PrevArrow />
  };

  return (
    <Slider {...settings}>
      {testimonials.map((testimonial, index) => (
        <div key={index} className="user_details" aria-hidden="true">
          <figure>
            <img src={testimonial.image} alt={testimonial.name} />
          </figure>
          <h3>{testimonial.name}</h3>
          <span>{testimonial.rank}</span>
          <div className="user_details_text_dummy">
            <p>{testimonial.message}</p>
          </div>
        </div>
      ))}
    </Slider>
  );
};

export default SliderComponent;

import React, { useEffect } from "react";
import "./Navbar.css";

const navbarData = [
  {
    label: "Classroom",
    subMenu: [
      {
        label: "Registration Form",
        link: "/web.registration",
      },
      {
        label: "JEE",
        subMenu: [
          {
            label: "Class 11th",
            link: "/web.courses.11.advanced",
          },
          {
            label: "Class 12th",
            link: "/web.courses.12.advanced",
          },
          {
            label: "Class 12th Pass",
            link: "/web.courses.12th.advanced",
          },
        ],
      },
      {
        label: "NEET",
        subMenu: [
          {
            label: "Class 11th",
            link: "/web.courses.11.neet",
          },
          {
            label: "Class 12th",
            link: "/web.courses.12.neet",
          },
          {
            label: "Class 12th Pass",
            link: "/web.courses.12th.neet",
          },
          {
            label: "Saransh NEET-25 Crash Course",
            link: "/web.neet.crash.course",
          },
        ],
      },
      {
        label: "Foundation",
        subMenu: [
          {
            label: "Study Material(Class 6th to 10th)",
            link: "/smp",
          },
          {
            label: "Tapasya",
            link: "/web.tapasya",
          },
          {
            label: "Foundation Offline",
            link: "/web.foundations.offline",
          },
        ],
      },
    ],
  },
  {
    label: "Residential Program",
    subMenu: [
      {
        label: "Dhruv Residential",
        link: "/dhruv-residential/",
      },
      {
        label: "Drona Residential",
        link: "/residential-coaching/drona/",
      },
    ],
  },
  {
    label: "Online Courses",
    subMenu: [
      {
        label: "JEE/NEET Brahmastra Test Series",
        link: "/brahmastra-test-series/",
      },
      {
        label: "JEE/NEET Live Classes",
        link: "/jee-neet-live-program/",
      },
      {
        label: "JEE Live Classes-Rakshak Batch",
        link: "/jee-live-program/",
      },
      {
        label: "JEE/NEET Video Lectures (Amrit Course)",
        link: "/jee-neet-online-amrit-course/",
      },
      {
        label: "Study Material Package",
        link: "/jee-neet-study-material-package/",
      },
      {
        label: "All India Test Series For JEE/NEET",
        link: "/Jee-neet-all-india-test-series/",
      },
      {
        label: "JEE Online Test Series (MTA)",
        link: "/jee-online-test-series/",
      },
      {
        label: "Self Study Package",
        link: "/jee-neet-video-lectures/",
      },
      {
        label: "JEE/NEET Revision Package",
        link: "/jee-neet-revision-package/",
      },
      {
        label: "Motion Olympiad Program (Online)",
        link: "/Motion-Olympiads-Program/",
      },
    ],
  },
  {
    label: "Pay Fee",
    subMenu: [
      {
        label: "Registration Form",
        link: "/web.registration",
      },
      {
        label: "Fee Payment",
        link: "/web.current.motion.student",
      },
    ],
  },
  {
    label: "Scholarship",
    subMenu: [
      {
        label: "Know Your Scholarship",
        link: "/web.kys",
      },
      {
        label: "Motion Talent Search Exam (MTSE 2.0)",
        link: "/mtse/",
      },
      {
        label: "Subject Selection Test",
        link: "/subject-selection-test/?utm_source=website&utm_medium=redirection&utm_campaign=subjectselectiontest/",
      },
    ],
  },
  {
    label: "Results",
    subMenu: [
      {
        label: "JEE",
        subMenu: [
          {
            label: "JEE Advanced",
            link: "/jee-advanced-result/",
          },
          {
            label: "JEE Main",
            link: "/jee-main-result/",
          },
        ],
      },
      {
        label: "NEET",
        link: "/pre-medical/neet-result/",
      },
      {
        label: "Olympiads",
        link: "/olympiads-result/",
      },
    ],
  },
];

const Navbar = () => {
  const host = window.location.hostname;

  useEffect(() => {
    document.getElementById("loadOverlay").style.display = "none";
  }, []);

  // Render the navbar dynamically based on the navbarData object
  const renderSubMenu = (subMenu) => {
    return (
      <ul className="level-2">
        {subMenu.map((item, index) => (
          <li key={index}>
            {item.subMenu ? (
              <>
                <span>
                  {item.label}
                </span>
                <i className="fa-solid fa-angle-right"></i>
                {renderSubMenu(item.subMenu)}
              </>
            ) : (
              <a href={item.link}>{item.label}</a> 
            )}
          </li>
        ))}
      </ul>
    );
  };

  return (
    <>
      <div
        id="loadOverlay"
        style={{
          backgroundColor: "#290404",
          position: "absolute",
          top: 0,
          left: 0,
          width: "100%",
          height: "100%",
          zIndex: 2000,
          display: "flex",
          justifyContent: "center",
          alignItems: "center",
        }}
      >
        <span className="startUpLoader"></span>
      </div>

      <header className="header">
        <div className="custom_container">
          {host !== "career.motion.ac.in" &&
          host !== "edustore.motion.ac.in" ? (
            <div className="header_logo">
              <a className="navbar-brand" href="/home">
                <img
                  src="https://cdn.motion.ac.in/ssp/img/images/university-logo-new.png"
                  alt="Best Coaching Institute for NEET, IIT-JEE, Motion Kota"
                />
              </a>
            </div>
          ) : (
            <div className="header_logo">
              <a className="navbar-brand" href="https://motion.ac.in">
                <img
                  src="https://cdn.motion.ac.in/ssp/img/images/university-logo-new.png"
                  alt="Best Coaching Institute for NEET, IIT-JEE, Motion Kota"
                />
              </a>
            </div>
          )}

          <button className="mobile_button" type="button" title="Motion Menu">
            <span className="navbar-toggler-icon">
              <i className="fa-solid fa-bars"></i>
            </span>
          </button>

          {host !== "career.motion.ac.in" &&
            host !== "edustore.motion.ac.in" && (
              <nav className="header_menu navbar-collapse">
                <span className="close_button">
                  <i className="fa-solid fa-xmark"></i>
                </span>
                <ul className="level-1">
                  {navbarData.map((menu, index) => (
                    <li key={index}>
                      <span className="toggle-font">
                        {menu.label} <i class="fa-solid fa-caret-down arrow_courses"></i>
                      </span>
                      {renderSubMenu(menu.subMenu)}
                    </li>
                  ))}
                </ul>
              </nav>
            )}
        </div>
      </header>
    </>
  );
};

export default Navbar;

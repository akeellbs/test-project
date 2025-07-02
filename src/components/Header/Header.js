// Header.jsx
import React, { useState } from 'react';
import './Header.css';

const Header = () => {
  const [isOpen, setIsOpen] = useState(false);
  const [activeSubmenu, setActiveSubmenu] = useState(null);
  const [activeSubSubmenu, setActiveSubSubmenu] = useState(null);

  const toggleMenu = () => {
    setIsOpen(!isOpen);
    setActiveSubmenu(null);
    setActiveSubSubmenu(null);
  };

  const toggleSubmenu = (index) => {
    setActiveSubmenu(activeSubmenu === index ? null : index);
    setActiveSubSubmenu(null);
  };

  const toggleSubSubmenu = (index) => {
    setActiveSubSubmenu(activeSubSubmenu === index ? null : index);
  };
  const menuItems = [
    {
      label: 'Classroom',

      submenu: [

        { label: 'Registration Form', link: './' },
        {
          label: 'JEE',
          subsubmenu: [
            { label: 'Class 11th', link: '/classroom/jee/class11' },
            { label: 'Class 12th', link: '/classroom/jee/class12' },
            { label: 'Class 12th Pass', link: '/classroom/jee/class12pass' },
          ]
        },
        {
          label: 'NEET',
          subsubmenu: [
            { label: 'Class 11th', link: '/classroom/jee/class11' },
            { label: 'Class 12th', link: '/classroom/jee/class12' },
            { label: 'Class 12th Pass', link: '/classroom/jee/class12pass' },
          ]
        },

        {
          label: 'Foundation',
          subsubmenu: [
            { label: 'Class 11th', link: '/classroom/jee/class11' },
            { label: 'Class 12th', link: '/classroom/jee/class12' },
            { label: 'Class 12th Pass', link: '/classroom/jee/class12pass' },
          ]
        },
      ]
    },
    {
      label: 'Residential Program',
      submenu: [
        { label: 'Dhruv Residential', link: './' },
        { label: 'Drona Residential', link: './' }
      ]
    },
    {
      label: 'Online Courses',
      submenu: [
        { label: 'Live Classes', link: './' },
        { label: 'Recorded Sessions', link: './' },
        { label: 'Study Material', link: './' }
      ]
    },
    {
      label: 'Pay Fee',
      submenu: [
        { label: 'Online Payment', link: './' },
        { label: 'Bank Transfer', link: './' },
        { label: 'Cash Payment', link: './' }
      ]
    },
    {
      label: 'Scholarship',
      submenu: [
        { label: 'Eligibility', link: './' },
        { label: 'Apply Now', link: './' },
        { label: 'Track Application', link: './' }
      ]
    },
    {
      label: 'Results',
      submenu: [
        { label: 'JEE Results', link: './' },
        { label: 'NEET Results', link: './' },
        { label: 'Foundation Results', link: './' }
      ]
    }
  ];

  return (
    <nav className="navbar">
      <div className="navbar-container">
        <div className="navbar-content">
          {/* Logo */}
          <div className="logo">
            <span className="logo-text">
              <img src="https://cdn.motion.ac.in/ssp/img/images/university-logo-new.png" alt="Best Coaching Institute for NEET, IIT-JEE, Motion Kota" className='logo_img' />
            </span>
          </div>

          {/* Mobile Menu Toggle */}
          <button
            className="mobile-menu-toggle"
            onClick={toggleMenu}
          >
            ☰
          </button>

          {/* Desktop Navigation */}
          <div className="nav-items desktop-nav">
            {menuItems.map((item, index) => (
              <div key={index} className="nav-item">
                <button className="nav-button">
                  {item.label}
                  <span className="dropdown-arrow">
                    <i className="fa-solid fa-caret-down arrow_courses"></i>
                  </span>
                </button>

                <div className="dropdown-menu">
                  {item.submenu.map((subItem, subIndex) => (
                    <div key={subIndex} className="dropdown-item">
                      {typeof subItem === 'string' ? (
                        <a href="#" className="dropdown-item">
                          {subItem}
                        </a>
                      ) : (
                        <div>
                          <a href={subItem.link} className="drop_down_sub">
                            {subItem.label}
                            {subItem.subsubmenu && (
                              <i className="fa-solid fa-caret-right arrow_courses"></i>
                            )}
                          </a>

                          {subItem.subsubmenu && (
                            <div className="subsubmenu">
                              {subItem.subsubmenu.map((subSubItem, subSubIndex) => (
                                <a key={subSubIndex} href={subSubItem.link} className="subsubmenu-item">
                                  {subSubItem.label}
                                </a>
                              ))}
                            </div>
                          )}
                        </div>
                      )}
                    </div>
                  ))}
                </div>
              </div>
            ))}
          </div>

          {/* Mobile Navigation */}
          <div className={`mobile-nav ${isOpen ? 'open' : ''}`}>
            <button
              className="mobile-nav-close"
              onClick={toggleMenu}
            >
              ×
            </button>
            {menuItems.map((item, index) => (
              <div key={index} className="mobile-nav-item">

                <button
                  className="mobile-nav-button"
                  onClick={() => toggleSubmenu(index)}
                >
                  {item.label}
                  <i className={`fa-solid fa-caret-right ${activeSubmenu === index ? 'rotate' : ''}`}></i>
                </button>

                <div className={`mobile-submenu ${activeSubmenu === index ? 'open' : ''}`}>
                  {item.submenu.map((subItem, subIndex) => (
                    <div key={subIndex} className="mobile-submenu-item">
                      {typeof subItem === 'string' ? (
                        <a href="#" className="mobile-submenu-link">
                          {subItem}
                        </a>
                      ) : (
                        <div>
                          {subItem.subsubmenu ? (
                            <button
                              className="mobile-submenu-button"
                              onClick={() => toggleSubSubmenu(subIndex)}
                            >
                              {subItem.label}
                              <i className={`fa-solid fa-caret-right ${activeSubSubmenu === subIndex ? 'rotate' : ''}`}></i>
                            </button>
                          ) : (
                            <a href={subItem.link} className="mobile-submenu-link">
                              {subItem.label}
                            </a>
                          )}

                          {subItem.subsubmenu && (
                            <div className={`mobile-subsubmenu ${activeSubSubmenu === subIndex ? 'open' : ''}`}>
                              {subItem.subsubmenu.map((subSubItem, subSubIndex) => (
                                <a
                                  key={subSubIndex}
                                  href={subSubItem.link}
                                  className="mobile-subsubmenu-link"
                                >
                                  {subSubItem.label}
                                </a>
                              ))}
                            </div>
                          )}
                        </div>
                      )}
                    </div>
                  ))}
                </div>
              </div>
            ))}
          </div>
        </div>
      </div>
    </nav>
  );
};


export default Header;
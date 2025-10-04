import React, { useState, useEffect } from 'react';
import { motion } from 'framer-motion';
import styled from 'styled-components';

const NavContainer = styled(motion.nav)`
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  z-index: 1000;
  padding: 20px 0;
  background: rgba(0, 0, 0, 0.1);
  backdrop-filter: blur(20px);
  border-bottom: 1px solid rgba(0, 255, 255, 0.1);
`;

const NavContent = styled.div`
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 20px;
  display: flex;
  justify-content: space-between;
  align-items: center;
`;

const Logo = styled(motion.div)`
  font-family: 'Orbitron', monospace;
  font-size: 1.8rem;
  font-weight: 900;
  color: #00ffff;
  text-shadow: 0 0 20px #00ffff;
  cursor: pointer;
`;

const NavMenu = styled.ul`
  display: flex;
  list-style: none;
  gap: 40px;
  
  @media (max-width: 768px) {
    display: ${props => props.isOpen ? 'flex' : 'none'};
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: rgba(0, 0, 0, 0.95);
    flex-direction: column;
    padding: 20px;
    gap: 20px;
  }
`;

const NavItem = styled(motion.li)`
  position: relative;
`;

const NavLink = styled.a`
  color: #ffffff;
  text-decoration: none;
  font-weight: 500;
  font-size: 1.1rem;
  letter-spacing: 1px;
  transition: all 0.3s ease;
  cursor: pointer;
  
  &:hover {
    color: #00ffff;
    text-shadow: 0 0 10px #00ffff;
  }
  
  &::after {
    content: '';
    position: absolute;
    bottom: -5px;
    left: 0;
    width: 0;
    height: 2px;
    background: linear-gradient(90deg, #00ffff, #ff00ff);
    transition: width 0.3s ease;
  }
  
  &:hover::after {
    width: 100%;
  }
`;

const MenuToggle = styled.div`
  display: none;
  flex-direction: column;
  cursor: pointer;
  
  @media (max-width: 768px) {
    display: flex;
  }
`;

const MenuLine = styled(motion.span)`
  width: 25px;
  height: 3px;
  background: #00ffff;
  margin: 3px 0;
  transition: 0.3s;
  box-shadow: 0 0 10px #00ffff;
`;

const SocialLinks = styled.div`
  display: flex;
  gap: 15px;
  
  @media (max-width: 768px) {
    display: none;
  }
`;

const SocialLink = styled(motion.a)`
  color: #888;
  font-size: 1.2rem;
  transition: all 0.3s ease;
  
  &:hover {
    color: #00ffff;
    transform: translateY(-2px);
    text-shadow: 0 0 10px #00ffff;
  }
`;

const Navbar = () => {
  const [isOpen, setIsOpen] = useState(false);
  const [scrolled, setScrolled] = useState(false);

  useEffect(() => {
    const handleScroll = () => {
      setScrolled(window.scrollY > 50);
    };
    
    window.addEventListener('scroll', handleScroll);
    return () => window.removeEventListener('scroll', handleScroll);
  }, []);

  const scrollToSection = (sectionId) => {
    const element = document.getElementById(sectionId);
    if (element) {
      element.scrollIntoView({ behavior: 'smooth' });
      setIsOpen(false);
    }
  };

  const navVariants = {
    hidden: { y: -100, opacity: 0 },
    visible: { 
      y: 0, 
      opacity: 1,
      transition: { duration: 0.8, ease: "easeOut" }
    }
  };

  const itemVariants = {
    hidden: { opacity: 0, x: -20 },
    visible: { 
      opacity: 1, 
      x: 0,
      transition: { duration: 0.5 }
    }
  };

  return (
    <NavContainer
      variants={navVariants}
      initial="hidden"
      animate="visible"
      style={{
        background: scrolled 
          ? 'rgba(0, 0, 0, 0.8)' 
          : 'rgba(0, 0, 0, 0.1)'
      }}
    >
      <NavContent>
        <Logo
          whileHover={{ scale: 1.05 }}
          whileTap={{ scale: 0.95 }}
          onClick={() => scrollToSection('hero')}
        >
          3D PORTFOLIO
        </Logo>

        <NavMenu isOpen={isOpen}>
          {['Home', 'About', 'Projects', 'Contact'].map((item, index) => (
            <NavItem
              key={item}
              variants={itemVariants}
              initial="hidden"
              animate="visible"
              transition={{ delay: index * 0.1 }}
            >
              <NavLink onClick={() => scrollToSection(item.toLowerCase())}>
                {item}
              </NavLink>
            </NavItem>
          ))}
        </NavMenu>

        <SocialLinks>
          <SocialLink
            href="https://github.com"
            target="_blank"
            whileHover={{ scale: 1.2, rotate: 5 }}
            whileTap={{ scale: 0.9 }}
          >
            <i className="fab fa-github"></i>
          </SocialLink>
          <SocialLink
            href="https://linkedin.com"
            target="_blank"
            whileHover={{ scale: 1.2, rotate: -5 }}
            whileTap={{ scale: 0.9 }}
          >
            <i className="fab fa-linkedin"></i>
          </SocialLink>
          <SocialLink
            href="https://twitter.com"
            target="_blank"
            whileHover={{ scale: 1.2, rotate: 5 }}
            whileTap={{ scale: 0.9 }}
          >
            <i className="fab fa-twitter"></i>
          </SocialLink>
        </SocialLinks>

        <MenuToggle onClick={() => setIsOpen(!isOpen)}>
          <MenuLine
            animate={{ rotate: isOpen ? 45 : 0, y: isOpen ? 6 : 0 }}
          />
          <MenuLine
            animate={{ opacity: isOpen ? 0 : 1 }}
          />
          <MenuLine
            animate={{ rotate: isOpen ? -45 : 0, y: isOpen ? -6 : 0 }}
          />
        </MenuToggle>
      </NavContent>
    </NavContainer>
  );
};

export default Navbar;
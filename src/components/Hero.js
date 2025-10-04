import React from 'react';
import { motion } from 'framer-motion';
import styled from 'styled-components';

const HeroContainer = styled.section`
  id: home;
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  position: relative;
  overflow: hidden;
  background: transparent;
`;

const HeroContent = styled.div`
  text-align: center;
  z-index: 2;
  max-width: 800px;
  padding: 0 20px;
`;

const HeroTitle = styled(motion.h1)`
  font-family: 'Orbitron', monospace;
  font-size: clamp(3rem, 8vw, 6rem);
  font-weight: 900;
  background: linear-gradient(45deg, #00ffff, #ff00ff, #ffff00);
  background-size: 200% 200%;
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  animation: gradient-shift 3s ease infinite;
  margin-bottom: 1rem;
  text-shadow: 0 0 50px rgba(0, 255, 255, 0.5);
  
  @keyframes gradient-shift {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
  }
`;

const HeroSubtitle = styled(motion.h2)`
  font-family: 'Rajdhani', sans-serif;
  font-size: clamp(1.2rem, 4vw, 2rem);
  color: #ffffff;
  margin-bottom: 2rem;
  font-weight: 300;
  letter-spacing: 2px;
  text-shadow: 0 0 20px rgba(255, 255, 255, 0.3);
`;

const HeroDescription = styled(motion.p)`
  font-size: clamp(1rem, 2.5vw, 1.3rem);
  color: #cccccc;
  line-height: 1.8;
  margin-bottom: 3rem;
  max-width: 600px;
  margin-left: auto;
  margin-right: auto;
`;

const ButtonContainer = styled(motion.div)`
  display: flex;
  gap: 20px;
  justify-content: center;
  flex-wrap: wrap;
`;

const CyberButton = styled(motion.button)`
  background: linear-gradient(45deg, #00ffff, #ff00ff);
  border: none;
  padding: 15px 40px;
  color: #000000;
  font-weight: bold;
  font-size: 1.1rem;
  text-transform: uppercase;
  letter-spacing: 2px;
  border-radius: 30px;
  cursor: pointer;
  position: relative;
  overflow: hidden;
  transition: all 0.3s ease;
  font-family: 'Orbitron', monospace;
  
  &::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
    transition: left 0.5s;
  }
  
  &:hover::before {
    left: 100%;
  }
  
  &:hover {
    box-shadow: 0 0 30px rgba(0, 255, 255, 0.6);
    transform: translateY(-3px);
  }
`;

const OutlineButton = styled(CyberButton)`
  background: transparent;
  color: #00ffff;
  border: 2px solid #00ffff;
  
  &:hover {
    background: #00ffff;
    color: #000000;
    box-shadow: 0 0 30px rgba(0, 255, 255, 0.6);
  }
`;

const ScrollIndicator = styled(motion.div)`
  position: absolute;
  bottom: 30px;
  left: 50%;
  transform: translateX(-50%);
  display: flex;
  flex-direction: column;
  align-items: center;
  color: #00ffff;
  cursor: pointer;
`;

const ScrollText = styled.span`
  font-family: 'Orbitron', monospace;
  font-size: 0.9rem;
  letter-spacing: 1px;
  margin-bottom: 10px;
  text-transform: uppercase;
`;

const ScrollArrow = styled(motion.div)`
  width: 20px;
  height: 20px;
  border-right: 2px solid #00ffff;
  border-bottom: 2px solid #00ffff;
  transform: rotate(45deg);
  filter: drop-shadow(0 0 5px #00ffff);
`;

const FloatingElements = styled.div`
  position: absolute;
  width: 100%;
  height: 100%;
  overflow: hidden;
  pointer-events: none;
`;

const FloatingShape = styled(motion.div)`
  position: absolute;
  width: ${props => props.size}px;
  height: ${props => props.size}px;
  border: 2px solid ${props => props.color};
  border-radius: ${props => props.rounded ? '50%' : '0'};
  opacity: 0.3;
  filter: blur(1px);
`;

const Hero = () => {
  const scrollToProjects = () => {
    document.getElementById('projects')?.scrollIntoView({ behavior: 'smooth' });
  };
  
  const scrollToContact = () => {
    document.getElementById('contact')?.scrollIntoView({ behavior: 'smooth' });
  };

  const titleVariants = {
    hidden: { opacity: 0, y: 50 },
    visible: { 
      opacity: 1, 
      y: 0,
      transition: { 
        duration: 1,
        ease: "easeOut"
      }
    }
  };

  const subtitleVariants = {
    hidden: { opacity: 0, x: -50 },
    visible: { 
      opacity: 1, 
      x: 0,
      transition: { 
        duration: 1,
        delay: 0.3,
        ease: "easeOut"
      }
    }
  };

  const descriptionVariants = {
    hidden: { opacity: 0, y: 30 },
    visible: { 
      opacity: 1, 
      y: 0,
      transition: { 
        duration: 1,
        delay: 0.6,
        ease: "easeOut"
      }
    }
  };

  const buttonVariants = {
    hidden: { opacity: 0, scale: 0.8 },
    visible: { 
      opacity: 1, 
      scale: 1,
      transition: { 
        duration: 0.8,
        delay: 0.9,
        ease: "easeOut"
      }
    }
  };

  return (
    <HeroContainer id="home">
      <FloatingElements>
        {[...Array(15)].map((_, i) => (
          <FloatingShape
            key={i}
            size={Math.random() * 60 + 20}
            color={['#00ffff', '#ff00ff', '#ffff00'][Math.floor(Math.random() * 3)]}
            rounded={Math.random() > 0.5}
            style={{
              left: `${Math.random() * 100}%`,
              top: `${Math.random() * 100}%`,
            }}
            animate={{
              y: [0, -30, 0],
              x: [0, Math.random() * 20 - 10, 0],
              rotate: [0, 360],
            }}
            transition={{
              duration: Math.random() * 10 + 10,
              repeat: Infinity,
              ease: "linear"
            }}
          />
        ))}
      </FloatingElements>

      <HeroContent>
        <HeroTitle
          variants={titleVariants}
          initial="hidden"
          animate="visible"
        >
          3D PORTFOLIO
        </HeroTitle>
        
        <HeroSubtitle
          variants={subtitleVariants}
          initial="hidden"
          animate="visible"
        >
          Immersive Digital Experience
        </HeroSubtitle>
        
        <HeroDescription
          variants={descriptionVariants}
          initial="hidden"
          animate="visible"
        >
          Welcome to my cyberpunk-inspired 3D portfolio. Explore stunning visual effects, 
          interactive 3D models, and cutting-edge web technologies that push the boundaries 
          of digital creativity.
        </HeroDescription>
        
        <ButtonContainer
          variants={buttonVariants}
          initial="hidden"
          animate="visible"
        >
          <CyberButton
            onClick={scrollToProjects}
            whileHover={{ scale: 1.05 }}
            whileTap={{ scale: 0.95 }}
          >
            Explore Projects
          </CyberButton>
          
          <OutlineButton
            onClick={scrollToContact}
            whileHover={{ scale: 1.05 }}
            whileTap={{ scale: 0.95 }}
          >
            Get in Touch
          </OutlineButton>
        </ButtonContainer>
      </HeroContent>
      
      <ScrollIndicator
        onClick={() => document.getElementById('about')?.scrollIntoView({ behavior: 'smooth' })}
        initial={{ opacity: 0 }}
        animate={{ opacity: 1 }}
        transition={{ delay: 1.5 }}
      >
        <ScrollText>Scroll Down</ScrollText>
        <ScrollArrow
          animate={{ y: [0, 10, 0] }}
          transition={{ duration: 1.5, repeat: Infinity }}
        />
      </ScrollIndicator>
    </HeroContainer>
  );
};

export default Hero;
import React from 'react';
import { motion } from 'framer-motion';
import styled from 'styled-components';

const AboutContainer = styled.section`
  min-height: 100vh;
  padding: 100px 20px;
  display: flex;
  align-items: center;
  background: transparent;
`;

const AboutContent = styled.div`
  max-width: 1200px;
  margin: 0 auto;
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 60px;
  align-items: center;
  
  @media (max-width: 768px) {
    grid-template-columns: 1fr;
    gap: 40px;
  }
`;

const TextSection = styled.div`
  z-index: 2;
`;

const Title = styled(motion.h2)`
  font-family: 'Orbitron', monospace;
  font-size: clamp(2.5rem, 5vw, 4rem);
  color: #00ffff;
  margin-bottom: 2rem;
  text-shadow: 0 0 20px #00ffff;
`;

const Description = styled(motion.p)`
  font-size: 1.2rem;
  line-height: 1.8;
  color: #cccccc;
  margin-bottom: 2rem;
`;

const SkillsGrid = styled(motion.div)`
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 20px;
  margin-top: 2rem;
  
  @media (max-width: 768px) {
    grid-template-columns: repeat(2, 1fr);
  }
`;

const SkillCard = styled(motion.div)`
  background: rgba(0, 255, 255, 0.1);
  border: 1px solid #00ffff;
  border-radius: 10px;
  padding: 20px;
  text-align: center;
  backdrop-filter: blur(10px);
  transition: all 0.3s ease;
  
  &:hover {
    background: rgba(0, 255, 255, 0.2);
    box-shadow: 0 0 20px rgba(0, 255, 255, 0.3);
    transform: translateY(-5px);
  }
`;

const SkillIcon = styled.div`
  font-size: 2rem;
  color: #00ffff;
  margin-bottom: 10px;
`;

const SkillName = styled.h4`
  color: #ffffff;
  font-family: 'Orbitron', monospace;
  font-size: 0.9rem;
  text-transform: uppercase;
  letter-spacing: 1px;
`;

const StatsSection = styled(motion.div)`
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 20px;
  margin-top: 3rem;
`;

const StatCard = styled(motion.div)`
  text-align: center;
  padding: 20px;
  background: rgba(255, 0, 255, 0.1);
  border: 1px solid #ff00ff;
  border-radius: 10px;
  backdrop-filter: blur(10px);
`;

const StatNumber = styled.h3`
  font-family: 'Orbitron', monospace;
  font-size: 2rem;
  color: #ff00ff;
  margin-bottom: 5px;
  text-shadow: 0 0 10px #ff00ff;
`;

const StatLabel = styled.p`
  color: #cccccc;
  font-size: 0.9rem;
  text-transform: uppercase;
  letter-spacing: 1px;
`;

const VisualsSection = styled.div`
  display: flex;
  justify-content: center;
  align-items: center;
  position: relative;
`;

const CyberAvatar = styled(motion.div)`
  width: 300px;
  height: 300px;
  border-radius: 50%;
  background: linear-gradient(45deg, #00ffff, #ff00ff, #ffff00);
  display: flex;
  align-items: center;
  justify-content: center;
  position: relative;
  
  &::before {
    content: '';
    position: absolute;
    top: -10px;
    left: -10px;
    right: -10px;
    bottom: -10px;
    border-radius: 50%;
    background: linear-gradient(45deg, #00ffff, #ff00ff, #ffff00);
    filter: blur(20px);
    opacity: 0.7;
    z-index: -1;
  }
`;

const AvatarContent = styled.div`
  width: 280px;
  height: 280px;
  border-radius: 50%;
  background: #000000;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 4rem;
  color: #00ffff;
`;

const About = () => {
  const skills = [
    { icon: 'fab fa-react', name: 'React' },
    { icon: 'fab fa-js', name: 'JavaScript' },
    { icon: 'fas fa-cube', name: 'Three.js' },
    { icon: 'fab fa-css3-alt', name: 'CSS3' },
    { icon: 'fab fa-html5', name: 'HTML5' },
    { icon: 'fab fa-node-js', name: 'Node.js' }
  ];

  const stats = [
    { number: '50+', label: 'Projects' },
    { number: '3+', label: 'Years Exp' },
    { number: '100%', label: 'Satisfaction' },
    { number: '24/7', label: 'Support' }
  ];

  return (
    <AboutContainer id="about">
      <AboutContent>
        <TextSection>
          <Title
            initial={{ opacity: 0, x: -50 }}
            whileInView={{ opacity: 1, x: 0 }}
            transition={{ duration: 0.8 }}
            viewport={{ once: true }}
          >
            About Me
          </Title>
          
          <Description
            initial={{ opacity: 0, y: 30 }}
            whileInView={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.8, delay: 0.2 }}
            viewport={{ once: true }}
          >
            I'm a passionate developer specializing in creating immersive 3D web experiences. 
            With expertise in modern web technologies and a keen eye for design, I bring 
            digital visions to life through interactive and visually stunning applications.
          </Description>
          
          <SkillsGrid
            initial={{ opacity: 0, y: 50 }}
            whileInView={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.8, delay: 0.4 }}
            viewport={{ once: true }}
          >
            {skills.map((skill, index) => (
              <SkillCard
                key={skill.name}
                whileHover={{ scale: 1.05 }}
                initial={{ opacity: 0, scale: 0.8 }}
                whileInView={{ opacity: 1, scale: 1 }}
                transition={{ duration: 0.5, delay: index * 0.1 }}
                viewport={{ once: true }}
              >
                <SkillIcon>
                  <i className={skill.icon}></i>
                </SkillIcon>
                <SkillName>{skill.name}</SkillName>
              </SkillCard>
            ))}
          </SkillsGrid>
          
          <StatsSection
            initial={{ opacity: 0, y: 30 }}
            whileInView={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.8, delay: 0.6 }}
            viewport={{ once: true }}
          >
            {stats.map((stat, index) => (
              <StatCard
                key={stat.label}
                whileHover={{ scale: 1.05 }}
                initial={{ opacity: 0, y: 20 }}
                whileInView={{ opacity: 1, y: 0 }}
                transition={{ duration: 0.5, delay: index * 0.1 }}
                viewport={{ once: true }}
              >
                <StatNumber>{stat.number}</StatNumber>
                <StatLabel>{stat.label}</StatLabel>
              </StatCard>
            ))}
          </StatsSection>
        </TextSection>
        
        <VisualsSection>
          <CyberAvatar
            animate={{ rotate: 360 }}
            transition={{ duration: 20, repeat: Infinity, ease: "linear" }}
            whileHover={{ scale: 1.1 }}
          >
            <AvatarContent>
              <i className="fas fa-user-astronaut"></i>
            </AvatarContent>
          </CyberAvatar>
        </VisualsSection>
      </AboutContent>
    </AboutContainer>
  );
};

export default About;
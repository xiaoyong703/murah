import React from 'react';
import { motion } from 'framer-motion';
import styled from 'styled-components';

const ProjectsContainer = styled.section`
  min-height: 100vh;
  padding: 100px 20px;
  background: transparent;
`;

const ProjectsContent = styled.div`
  max-width: 1400px;
  margin: 0 auto;
`;

const Title = styled(motion.h2)`
  font-family: 'Orbitron', monospace;
  font-size: clamp(2.5rem, 5vw, 4rem);
  color: #ff00ff;
  text-align: center;
  margin-bottom: 3rem;
  text-shadow: 0 0 20px #ff00ff;
`;

const ProjectsGrid = styled(motion.div)`
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
  gap: 40px;
  margin-top: 4rem;
  
  @media (max-width: 768px) {
    grid-template-columns: 1fr;
    gap: 30px;
  }
`;

const ProjectCard = styled(motion.div)`
  background: rgba(0, 0, 0, 0.7);
  border: 1px solid rgba(255, 255, 255, 0.1);
  border-radius: 20px;
  overflow: hidden;
  backdrop-filter: blur(20px);
  transition: all 0.3s ease;
  cursor: pointer;
  
  &:hover {
    border-color: #00ffff;
    box-shadow: 0 10px 30px rgba(0, 255, 255, 0.3);
    transform: translateY(-10px);
  }
`;

const ProjectImage = styled.div`
  height: 250px;
  background: linear-gradient(45deg, ${props => props.gradient});
  display: flex;
  align-items: center;
  justify-content: center;
  position: relative;
  overflow: hidden;
  
  &::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.3);
  }
`;

const ProjectIcon = styled.div`
  font-size: 4rem;
  color: white;
  z-index: 2;
  text-shadow: 0 0 20px currentColor;
`;

const ProjectContent = styled.div`
  padding: 30px;
`;

const ProjectTitle = styled.h3`
  font-family: 'Orbitron', monospace;
  font-size: 1.5rem;
  color: #ffffff;
  margin-bottom: 15px;
  text-transform: uppercase;
  letter-spacing: 1px;
`;

const ProjectDescription = styled.p`
  color: #cccccc;
  line-height: 1.6;
  margin-bottom: 20px;
  font-size: 1rem;
`;

const TechStack = styled.div`
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin-bottom: 25px;
`;

const TechTag = styled.span`
  background: rgba(0, 255, 255, 0.1);
  color: #00ffff;
  padding: 5px 12px;
  border-radius: 15px;
  font-size: 0.8rem;
  border: 1px solid rgba(0, 255, 255, 0.3);
  text-transform: uppercase;
  letter-spacing: 0.5px;
`;

const ProjectLinks = styled.div`
  display: flex;
  gap: 15px;
`;

const ProjectLink = styled(motion.a)`
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 10px 20px;
  background: linear-gradient(45deg, #00ffff, #ff00ff);
  color: #000000;
  text-decoration: none;
  border-radius: 25px;
  font-weight: 600;
  font-size: 0.9rem;
  text-transform: uppercase;
  letter-spacing: 1px;
  transition: all 0.3s ease;
  
  &:hover {
    box-shadow: 0 0 20px rgba(0, 255, 255, 0.5);
    transform: translateY(-2px);
  }
`;

const OutlineLink = styled(ProjectLink)`
  background: transparent;
  color: #00ffff;
  border: 2px solid #00ffff;
  
  &:hover {
    background: #00ffff;
    color: #000000;
  }
`;

const Projects = () => {
  const projects = [
    {
      id: 1,
      title: '3D Portfolio Site',
      description: 'An immersive 3D portfolio website built with React Three Fiber, featuring interactive models, particle systems, and smooth animations.',
      gradient: '#00ffff, #ff00ff',
      icon: 'fas fa-cube',
      tech: ['React', 'Three.js', 'WebGL', 'Framer Motion'],
      liveLink: '#',
      codeLink: '#'
    },
    {
      id: 2,
      title: 'Cyberpunk Dashboard',
      description: 'A futuristic data visualization dashboard with real-time charts, neon aesthetics, and interactive 3D elements.',
      gradient: '#ff00ff, #ffff00',
      icon: 'fas fa-chart-line',
      tech: ['React', 'D3.js', 'WebSocket', 'CSS3'],
      liveLink: '#',
      codeLink: '#'
    },
    {
      id: 3,
      title: 'VR Gallery Experience',
      description: 'A virtual reality art gallery where users can explore 3D artworks in an immersive environment using WebXR.',
      gradient: '#ffff00, #00ffff',
      icon: 'fas fa-vr-cardboard',
      tech: ['WebXR', 'A-Frame', 'Three.js', 'WebGL'],
      liveLink: '#',
      codeLink: '#'
    },
    {
      id: 4,
      title: 'Neural Network Viz',
      description: 'Interactive visualization of neural networks with 3D nodes and connections, showing real-time learning processes.',
      gradient: '#ff6b6b, #4ecdc4',
      icon: 'fas fa-brain',
      tech: ['TensorFlow.js', 'Three.js', 'WebGL', 'React'],
      liveLink: '#',
      codeLink: '#'
    },
    {
      id: 5,
      title: 'Holographic Interface',
      description: 'A sci-fi inspired holographic user interface with floating panels, particle effects, and gesture controls.',
      gradient: '#a8e6cf, #dcedc8',
      icon: 'fas fa-hand-paper',
      tech: ['WebGL', 'Three.js', 'MediaPipe', 'Canvas API'],
      liveLink: '#',
      codeLink: '#'
    },
    {
      id: 6,
      title: 'Space Exploration App',
      description: 'An educational 3D space exploration application featuring realistic planet models and orbital mechanics.',
      gradient: '#667eea, #764ba2',
      icon: 'fas fa-rocket',
      tech: ['React', 'Three.js', 'WebGL', 'NASA API'],
      liveLink: '#',
      codeLink: '#'
    }
  ];

  const containerVariants = {
    hidden: { opacity: 0 },
    visible: {
      opacity: 1,
      transition: {
        staggerChildren: 0.1
      }
    }
  };

  const cardVariants = {
    hidden: { opacity: 0, y: 50 },
    visible: {
      opacity: 1,
      y: 0,
      transition: {
        duration: 0.6,
        ease: "easeOut"
      }
    }
  };

  return (
    <ProjectsContainer id="projects">
      <ProjectsContent>
        <Title
          initial={{ opacity: 0, y: -30 }}
          whileInView={{ opacity: 1, y: 0 }}
          transition={{ duration: 0.8 }}
          viewport={{ once: true }}
        >
          Featured Projects
        </Title>
        
        <ProjectsGrid
          variants={containerVariants}
          initial="hidden"
          whileInView="visible"
          viewport={{ once: true, margin: "-100px" }}
        >
          {projects.map((project) => (
            <ProjectCard
              key={project.id}
              variants={cardVariants}
              whileHover={{ scale: 1.02 }}
              whileTap={{ scale: 0.98 }}
            >
              <ProjectImage gradient={project.gradient}>
                <ProjectIcon>
                  <i className={project.icon}></i>
                </ProjectIcon>
              </ProjectImage>
              
              <ProjectContent>
                <ProjectTitle>{project.title}</ProjectTitle>
                <ProjectDescription>{project.description}</ProjectDescription>
                
                <TechStack>
                  {project.tech.map((tech, index) => (
                    <TechTag key={index}>{tech}</TechTag>
                  ))}
                </TechStack>
                
                <ProjectLinks>
                  <ProjectLink
                    href={project.liveLink}
                    whileHover={{ scale: 1.05 }}
                    whileTap={{ scale: 0.95 }}
                  >
                    <i className="fas fa-external-link-alt"></i>
                    Live Demo
                  </ProjectLink>
                  
                  <OutlineLink
                    href={project.codeLink}
                    whileHover={{ scale: 1.05 }}
                    whileTap={{ scale: 0.95 }}
                  >
                    <i className="fab fa-github"></i>
                    Code
                  </OutlineLink>
                </ProjectLinks>
              </ProjectContent>
            </ProjectCard>
          ))}
        </ProjectsGrid>
      </ProjectsContent>
    </ProjectsContainer>
  );
};

export default Projects;
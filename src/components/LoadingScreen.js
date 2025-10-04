import React from 'react';
import { motion } from 'framer-motion';
import styled from 'styled-components';

const LoadingContainer = styled(motion.div)`
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(45deg, #0a0a0a, #1a1a2e, #16213e);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 9999;
`;

const LoadingContent = styled.div`
  text-align: center;
`;

const Spinner = styled(motion.div)`
  width: 80px;
  height: 80px;
  border: 4px solid rgba(0, 255, 255, 0.1);
  border-top: 4px solid #00ffff;
  border-radius: 50%;
  margin: 0 auto 30px;
`;

const LoadingText = styled(motion.h2)`
  font-family: 'Orbitron', monospace;
  font-size: 1.5rem;
  color: #00ffff;
  text-transform: uppercase;
  letter-spacing: 3px;
  text-shadow: 0 0 20px #00ffff;
`;

const ProgressBar = styled(motion.div)`
  width: 300px;
  height: 4px;
  background: rgba(0, 255, 255, 0.2);
  border-radius: 2px;
  margin: 20px auto;
  overflow: hidden;
`;

const Progress = styled(motion.div)`
  height: 100%;
  background: linear-gradient(90deg, #00ffff, #ff00ff, #ffff00);
  border-radius: 2px;
`;

const LoadingScreen = () => {
  return (
    <LoadingContainer
      initial={{ opacity: 1 }}
      exit={{ opacity: 0 }}
      transition={{ duration: 1 }}
    >
      <LoadingContent>
        <Spinner
          animate={{ rotate: 360 }}
          transition={{ duration: 1, repeat: Infinity, ease: "linear" }}
        />
        
        <LoadingText
          initial={{ opacity: 0, y: 20 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ delay: 0.5 }}
        >
          Loading 3D Portfolio
        </LoadingText>
        
        <ProgressBar>
          <Progress
            initial={{ width: 0 }}
            animate={{ width: "100%" }}
            transition={{ duration: 2.5, ease: "easeInOut" }}
          />
        </ProgressBar>
        
        <motion.p
          style={{ 
            color: '#888', 
            marginTop: '20px',
            fontFamily: 'Rajdhani, sans-serif'
          }}
          initial={{ opacity: 0 }}
          animate={{ opacity: 1 }}
          transition={{ delay: 1 }}
        >
          Preparing immersive experience...
        </motion.p>
      </LoadingContent>
    </LoadingContainer>
  );
};

export default LoadingScreen;
import React, { Suspense, useEffect, useState } from 'react';
import { Canvas } from '@react-three/fiber';
import { Environment, OrbitControls, Stars } from '@react-three/drei';
import { motion, AnimatePresence } from 'framer-motion';
import styled from 'styled-components';
import Navbar from './components/Navbar';
import Hero from './components/Hero';
import About from './components/About';
import Projects from './components/Projects';
import Contact from './components/Contact';
import Scene3D from './components/Scene3D';
import LoadingScreen from './components/LoadingScreen';
import './App.css';

const AppContainer = styled.div`
  position: relative;
  min-height: 100vh;
  background: radial-gradient(ellipse at bottom, #1B2735 0%, #090A0F 100%);
  overflow-x: hidden;
`;

const CanvasContainer = styled.div`
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: -1;
`;

const ContentContainer = styled.div`
  position: relative;
  z-index: 1;
`;

const ScrollIndicator = styled(motion.div)`
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  height: 4px;
  background: linear-gradient(90deg, #00ffff, #ff00ff, #ffff00);
  transform-origin: 0%;
  z-index: 1000;
`;

function App() {
  const [loading, setLoading] = useState(true);
  const [scrollY, setScrollY] = useState(0);

  useEffect(() => {
    const timer = setTimeout(() => {
      setLoading(false);
    }, 3000);

    return () => clearTimeout(timer);
  }, []);

  useEffect(() => {
    const updateScrollY = () => setScrollY(window.scrollY);
    window.addEventListener('scroll', updateScrollY);
    return () => window.removeEventListener('scroll', updateScrollY);
  }, []);

  const scrollProgress = scrollY / (document.documentElement.scrollHeight - window.innerHeight);

  return (
    <AppContainer>
      <AnimatePresence>
        {loading && <LoadingScreen />}
      </AnimatePresence>

      <ScrollIndicator
        style={{ scaleX: scrollProgress }}
        initial={{ scaleX: 0 }}
        animate={{ scaleX: scrollProgress }}
      />

      <CanvasContainer>
        <Canvas
          camera={{ position: [0, 0, 10], fov: 75 }}
          gl={{ antialias: true, alpha: true }}
        >
          <Suspense fallback={null}>
            <Stars
              radius={300}
              depth={60}
              count={20000}
              factor={7}
              saturation={0}
              fade={true}
            />
            <Environment preset="night" />
            <Scene3D scrollY={scrollY} />
          </Suspense>
        </Canvas>
      </CanvasContainer>

      <ContentContainer>
        <Navbar />
        <Hero />
        <About />
        <Projects />
        <Contact />
      </ContentContainer>
    </AppContainer>
  );
}

export default App;
import React, { useRef } from 'react';
import { useFrame } from '@react-three/fiber';
import { Sphere, MeshDistortMaterial, Float, Text3D, Center } from '@react-three/drei';
import * as THREE from 'three';

const FloatingOrb = ({ position, color, speed = 1 }) => {
  const meshRef = useRef();
  
  useFrame((state) => {
    if (meshRef.current) {
      meshRef.current.rotation.x = state.clock.elapsedTime * speed * 0.2;
      meshRef.current.rotation.y = state.clock.elapsedTime * speed * 0.3;
      meshRef.current.position.y = position[1] + Math.sin(state.clock.elapsedTime * speed) * 0.5;
    }
  });

  return (
    <Float
      speed={2}
      rotationIntensity={1}
      floatIntensity={2}
      position={position}
    >
      <Sphere ref={meshRef} args={[1, 64, 64]}>
        <MeshDistortMaterial
          color={color}
          attach="material"
          distort={0.4}
          speed={2}
          roughness={0.1}
          metalness={0.8}
        />
      </Sphere>
    </Float>
  );
};

const RotatingTorus = ({ position, color, size = [1, 0.4, 16, 100] }) => {
  const meshRef = useRef();
  
  useFrame((state) => {
    if (meshRef.current) {
      meshRef.current.rotation.x = state.clock.elapsedTime * 0.5;
      meshRef.current.rotation.y = state.clock.elapsedTime * 0.3;
      meshRef.current.rotation.z = state.clock.elapsedTime * 0.1;
    }
  });

  return (
    <mesh ref={meshRef} position={position}>
      <torusGeometry args={size} />
      <meshStandardMaterial
        color={color}
        metalness={0.8}
        roughness={0.2}
        emissive={color}
        emissiveIntensity={0.2}
      />
    </mesh>
  );
};

const Particles = ({ count = 1000 }) => {
  const meshRef = useRef();
  const particlesPosition = new Float32Array(count * 3);
  
  for (let i = 0; i < count; i++) {
    particlesPosition[i * 3] = (Math.random() - 0.5) * 50;
    particlesPosition[i * 3 + 1] = (Math.random() - 0.5) * 50;
    particlesPosition[i * 3 + 2] = (Math.random() - 0.5) * 50;
  }
  
  useFrame((state) => {
    if (meshRef.current) {
      meshRef.current.rotation.y = state.clock.elapsedTime * 0.05;
    }
  });

  return (
    <points ref={meshRef}>
      <bufferGeometry>
        <bufferAttribute
          attach="attributes-position"
          count={count}
          array={particlesPosition}
          itemSize={3}
        />
      </bufferGeometry>
      <pointsMaterial
        color="#00ffff"
        size={0.02}
        sizeAttenuation={true}
        transparent={true}
        opacity={0.6}
      />
    </points>
  );
};

const Scene3D = ({ scrollY }) => {
  const groupRef = useRef();
  
  useFrame((state) => {
    if (groupRef.current) {
      groupRef.current.rotation.y = scrollY * 0.001;
    }
  });

  return (
    <group ref={groupRef}>
      {/* Ambient and directional lighting */}
      <ambientLight intensity={0.3} />
      <directionalLight position={[10, 10, 5]} intensity={1} color="#00ffff" />
      <directionalLight position={[-10, -10, -5]} intensity={0.5} color="#ff00ff" />
      
      {/* Point lights for atmosphere */}
      <pointLight position={[10, 0, 10]} color="#00ffff" intensity={2} />
      <pointLight position={[-10, 0, -10]} color="#ff00ff" intensity={2} />
      <pointLight position={[0, 10, 0]} color="#ffff00" intensity={1} />
      
      {/* Floating orbs */}
      <FloatingOrb position={[-4, 2, -2]} color="#00ffff" speed={1} />
      <FloatingOrb position={[4, -1, -3]} color="#ff00ff" speed={1.5} />
      <FloatingOrb position={[0, 3, -5]} color="#ffff00" speed={0.8} />
      <FloatingOrb position={[-6, -2, -1]} color="#ff6b6b" speed={1.2} />
      <FloatingOrb position={[6, 1, -4]} color="#4ecdc4" speed={0.9} />
      
      {/* Rotating torus shapes */}
      <RotatingTorus position={[8, 4, -8]} color="#00ffff" size={[2, 0.5, 16, 100]} />
      <RotatingTorus position={[-8, -3, -6]} color="#ff00ff" size={[1.5, 0.3, 12, 80]} />
      <RotatingTorus position={[3, -5, -10]} color="#ffff00" size={[1, 0.2, 8, 60]} />
      
      {/* Particle system */}
      <Particles count={2000} />
      
      {/* Animated geometric shapes */}
      <Float speed={1} rotationIntensity={0.5} floatIntensity={1} position={[0, -8, -5]}>
        <mesh>
          <dodecahedronGeometry args={[2]} />
          <meshStandardMaterial
            color="#00ffff"
            metalness={0.9}
            roughness={0.1}
            emissive="#00ffff"
            emissiveIntensity={0.1}
          />
        </mesh>
      </Float>
      
      <Float speed={1.5} rotationIntensity={0.8} floatIntensity={1.5} position={[10, 0, -15]}>
        <mesh>
          <octahedronGeometry args={[1.5]} />
          <meshStandardMaterial
            color="#ff00ff"
            metalness={0.8}
            roughness={0.2}
            emissive="#ff00ff"
            emissiveIntensity={0.1}
          />
        </mesh>
      </Float>
      
      <Float speed={0.8} rotationIntensity={0.3} floatIntensity={0.8} position={[-10, 5, -12]}>
        <mesh>
          <icosahedronGeometry args={[1.2]} />
          <meshStandardMaterial
            color="#ffff00"
            metalness={0.7}
            roughness={0.3}
            emissive="#ffff00"
            emissiveIntensity={0.1}
          />
        </mesh>
      </Float>
    </group>
  );
};

export default Scene3D;
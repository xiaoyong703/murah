import React, { useState } from 'react';
import { motion } from 'framer-motion';
import styled from 'styled-components';

const ContactContainer = styled.section`
  min-height: 100vh;
  padding: 100px 20px;
  display: flex;
  align-items: center;
  background: transparent;
`;

const ContactContent = styled.div`
  max-width: 1200px;
  margin: 0 auto;
  width: 100%;
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 60px;
  
  @media (max-width: 768px) {
    grid-template-columns: 1fr;
    gap: 40px;
  }
`;

const ContactInfo = styled.div`
  z-index: 2;
`;

const Title = styled(motion.h2)`
  font-family: 'Orbitron', monospace;
  font-size: clamp(2.5rem, 5vw, 4rem);
  color: #ffff00;
  margin-bottom: 2rem;
  text-shadow: 0 0 20px #ffff00;
`;

const Description = styled(motion.p)`
  font-size: 1.2rem;
  line-height: 1.8;
  color: #cccccc;
  margin-bottom: 3rem;
`;

const ContactMethods = styled(motion.div)`
  display: flex;
  flex-direction: column;
  gap: 25px;
  margin-bottom: 3rem;
`;

const ContactMethod = styled(motion.div)`
  display: flex;
  align-items: center;
  gap: 20px;
  padding: 20px;
  background: rgba(255, 255, 0, 0.1);
  border: 1px solid rgba(255, 255, 0, 0.3);
  border-radius: 15px;
  backdrop-filter: blur(10px);
  transition: all 0.3s ease;
  
  &:hover {
    background: rgba(255, 255, 0, 0.2);
    border-color: #ffff00;
    box-shadow: 0 0 20px rgba(255, 255, 0, 0.3);
    transform: translateX(10px);
  }
`;

const ContactIcon = styled.div`
  width: 50px;
  height: 50px;
  background: linear-gradient(45deg, #ffff00, #ff00ff);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.2rem;
  color: #000000;
`;

const ContactText = styled.div`
  h4 {
    color: #ffffff;
    font-family: 'Orbitron', monospace;
    margin-bottom: 5px;
    text-transform: uppercase;
    letter-spacing: 1px;
  }
  
  p {
    color: #cccccc;
    margin: 0;
  }
`;

const SocialLinks = styled(motion.div)`
  display: flex;
  gap: 20px;
`;

const SocialLink = styled(motion.a)`
  width: 60px;
  height: 60px;
  background: linear-gradient(45deg, #00ffff, #ff00ff);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.5rem;
  color: #000000;
  text-decoration: none;
  transition: all 0.3s ease;
  
  &:hover {
    box-shadow: 0 0 20px rgba(0, 255, 255, 0.5);
    transform: translateY(-5px) rotate(10deg);
  }
`;

const ContactForm = styled(motion.form)`
  background: rgba(0, 0, 0, 0.5);
  padding: 40px;
  border-radius: 20px;
  border: 1px solid rgba(255, 255, 255, 0.1);
  backdrop-filter: blur(20px);
`;

const FormGroup = styled.div`
  margin-bottom: 25px;
`;

const Label = styled.label`
  display: block;
  color: #ffffff;
  font-family: 'Orbitron', monospace;
  font-size: 0.9rem;
  text-transform: uppercase;
  letter-spacing: 1px;
  margin-bottom: 8px;
`;

const Input = styled.input`
  width: 100%;
  padding: 15px;
  background: rgba(0, 0, 0, 0.7);
  border: 1px solid rgba(0, 255, 255, 0.3);
  border-radius: 10px;
  color: #ffffff;
  font-size: 1rem;
  transition: all 0.3s ease;
  
  &:focus {
    outline: none;
    border-color: #00ffff;
    box-shadow: 0 0 15px rgba(0, 255, 255, 0.3);
  }
  
  &::placeholder {
    color: #888888;
  }
`;

const TextArea = styled.textarea`
  width: 100%;
  padding: 15px;
  background: rgba(0, 0, 0, 0.7);
  border: 1px solid rgba(0, 255, 255, 0.3);
  border-radius: 10px;
  color: #ffffff;
  font-size: 1rem;
  min-height: 120px;
  resize: vertical;
  font-family: inherit;
  transition: all 0.3s ease;
  
  &:focus {
    outline: none;
    border-color: #00ffff;
    box-shadow: 0 0 15px rgba(0, 255, 255, 0.3);
  }
  
  &::placeholder {
    color: #888888;
  }
`;

const SubmitButton = styled(motion.button)`
  width: 100%;
  padding: 15px 30px;
  background: linear-gradient(45deg, #00ffff, #ff00ff);
  border: none;
  border-radius: 25px;
  color: #000000;
  font-weight: bold;
  font-size: 1.1rem;
  text-transform: uppercase;
  letter-spacing: 2px;
  cursor: pointer;
  font-family: 'Orbitron', monospace;
  transition: all 0.3s ease;
  
  &:hover {
    box-shadow: 0 0 30px rgba(0, 255, 255, 0.5);
    transform: translateY(-2px);
  }
  
  &:disabled {
    opacity: 0.7;
    cursor: not-allowed;
  }
`;

const StatusMessage = styled(motion.div)`
  margin-top: 20px;
  padding: 15px;
  border-radius: 10px;
  text-align: center;
  font-weight: 500;
  
  &.success {
    background: rgba(0, 255, 0, 0.1);
    border: 1px solid rgba(0, 255, 0, 0.3);
    color: #00ff00;
  }
  
  &.error {
    background: rgba(255, 0, 0, 0.1);
    border: 1px solid rgba(255, 0, 0, 0.3);
    color: #ff0000;
  }
`;

const Contact = () => {
  const [formData, setFormData] = useState({
    name: '',
    email: '',
    subject: '',
    message: ''
  });
  const [status, setStatus] = useState('');
  const [isSubmitting, setIsSubmitting] = useState(false);

  const handleChange = (e) => {
    setFormData({
      ...formData,
      [e.target.name]: e.target.value
    });
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    setIsSubmitting(true);
    
    // Simulate form submission
    setTimeout(() => {
      setStatus('success');
      setIsSubmitting(false);
      setFormData({ name: '', email: '', subject: '', message: '' });
      
      setTimeout(() => {
        setStatus('');
      }, 5000);
    }, 2000);
  };

  const contactMethods = [
    {
      icon: 'fas fa-envelope',
      title: 'Email',
      value: 'hello@3dportfolio.com'
    },
    {
      icon: 'fas fa-phone',
      title: 'Phone',
      value: '+1 (555) 123-4567'
    },
    {
      icon: 'fas fa-map-marker-alt',
      title: 'Location',
      value: 'San Francisco, CA'
    }
  ];

  const socialLinks = [
    { icon: 'fab fa-github', url: 'https://github.com' },
    { icon: 'fab fa-linkedin', url: 'https://linkedin.com' },
    { icon: 'fab fa-twitter', url: 'https://twitter.com' },
    { icon: 'fab fa-dribbble', url: 'https://dribbble.com' }
  ];

  return (
    <ContactContainer id="contact">
      <ContactContent>
        <ContactInfo>
          <Title
            initial={{ opacity: 0, x: -50 }}
            whileInView={{ opacity: 1, x: 0 }}
            transition={{ duration: 0.8 }}
            viewport={{ once: true }}
          >
            Get In Touch
          </Title>
          
          <Description
            initial={{ opacity: 0, y: 30 }}
            whileInView={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.8, delay: 0.2 }}
            viewport={{ once: true }}
          >
            Ready to bring your ideas to life? Let's collaborate on creating 
            something extraordinary. I'm always excited to work on innovative 
            projects that push the boundaries of web technology.
          </Description>
          
          <ContactMethods
            initial={{ opacity: 0, y: 50 }}
            whileInView={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.8, delay: 0.4 }}
            viewport={{ once: true }}
          >
            {contactMethods.map((method, index) => (
              <ContactMethod
                key={index}
                whileHover={{ scale: 1.02 }}
                initial={{ opacity: 0, x: -30 }}
                whileInView={{ opacity: 1, x: 0 }}
                transition={{ duration: 0.5, delay: index * 0.1 }}
                viewport={{ once: true }}
              >
                <ContactIcon>
                  <i className={method.icon}></i>
                </ContactIcon>
                <ContactText>
                  <h4>{method.title}</h4>
                  <p>{method.value}</p>
                </ContactText>
              </ContactMethod>
            ))}
          </ContactMethods>
          
          <SocialLinks
            initial={{ opacity: 0, y: 30 }}
            whileInView={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.8, delay: 0.6 }}
            viewport={{ once: true }}
          >
            {socialLinks.map((social, index) => (
              <SocialLink
                key={index}
                href={social.url}
                target="_blank"
                rel="noopener noreferrer"
                whileHover={{ scale: 1.1, rotate: 15 }}
                whileTap={{ scale: 0.9 }}
                initial={{ opacity: 0, scale: 0 }}
                whileInView={{ opacity: 1, scale: 1 }}
                transition={{ duration: 0.5, delay: index * 0.1 }}
                viewport={{ once: true }}
              >
                <i className={social.icon}></i>
              </SocialLink>
            ))}
          </SocialLinks>
        </ContactInfo>
        
        <ContactForm
          onSubmit={handleSubmit}
          initial={{ opacity: 0, x: 50 }}
          whileInView={{ opacity: 1, x: 0 }}
          transition={{ duration: 0.8, delay: 0.3 }}
          viewport={{ once: true }}
        >
          <FormGroup>
            <Label htmlFor="name">Name</Label>
            <Input
              type="text"
              id="name"
              name="name"
              value={formData.name}
              onChange={handleChange}
              placeholder="Your Name"
              required
            />
          </FormGroup>
          
          <FormGroup>
            <Label htmlFor="email">Email</Label>
            <Input
              type="email"
              id="email"
              name="email"
              value={formData.email}
              onChange={handleChange}
              placeholder="your.email@example.com"
              required
            />
          </FormGroup>
          
          <FormGroup>
            <Label htmlFor="subject">Subject</Label>
            <Input
              type="text"
              id="subject"
              name="subject"
              value={formData.subject}
              onChange={handleChange}
              placeholder="Project Discussion"
              required
            />
          </FormGroup>
          
          <FormGroup>
            <Label htmlFor="message">Message</Label>
            <TextArea
              id="message"
              name="message"
              value={formData.message}
              onChange={handleChange}
              placeholder="Tell me about your project..."
              required
            />
          </FormGroup>
          
          <SubmitButton
            type="submit"
            disabled={isSubmitting}
            whileHover={{ scale: 1.02 }}
            whileTap={{ scale: 0.98 }}
          >
            {isSubmitting ? 'Sending...' : 'Send Message'}
          </SubmitButton>
          
          {status && (
            <StatusMessage
              className={status}
              initial={{ opacity: 0, y: 20 }}
              animate={{ opacity: 1, y: 0 }}
            >
              {status === 'success' 
                ? 'Message sent successfully! I\'ll get back to you soon.' 
                : 'Something went wrong. Please try again.'}
            </StatusMessage>
          )}
        </ContactForm>
      </ContactContent>
    </ContactContainer>
  );
};

export default Contact;
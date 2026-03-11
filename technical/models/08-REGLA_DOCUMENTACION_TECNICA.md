# 📜 REGLA GLOBAL: CREACIÓN Y ALMACENAMIENTO DE DOCUMENTACIÓN TÉCNICA

**Firma:** MODUS AXON  
**Versión:** 1.0  
**Ámbito:** Todos los proyectos de desarrollo y diseño (Web y Móvil)  

---

## 📌 1. Ubicación OBLIGATORIA de la Documentación
Toda la documentación técnica generada para cualquier proyecto **DEBE** guardarse, sin excepción, en una carpeta llamada `technical` ubicada en la raíz del proyecto correspondiente (ejemplo: `/[Nombre_del_Proyecto]/technical/`). 

## 🧠 2. Fuente de Verdad y Marco Normativo (NotebookLM)
El contenido, estructura, y requerimientos de diseño de aplicaciones (en todas sus fases y elementos para apps web o móviles) estarán basados estrictamente en **los cuadernos de NotebookLM**. Estos cuadernos contienen toda la base de conocimiento y el **marco normativo Colombiano e internacional** necesario para asegurar el cumplimiento, la accesibilidad, y los estándares de calidad definidos por MODUS AXON.
- Antes de redactar o generar documentación, el agente debe consultar (o basar su conocimiento en) dichos cuadernos alojados en NotebookLM.

## 🤖 3. Ejecución Guiada por Skills (Proyecto `agent`)
La aplicación de esta regla y la creación de los documentos son procesos guiados exclusivamente por las habilidades (**skills**) definidas en el proyecto `agent` (p. ej. `documentador-tecnico`, `compliance-legal`, etc.). El agente respetará el flujo de trabajo orquestado por estas habilidades para garantizar homogeneidad y precisión.

## 📁 4. Modelos de Referencia Oficiales
Para la redacción y generación de todos los documentos aplicables al proyecto, se utilizarán invariablemente los modelos, plantillas y archivos oficiales que se encuentran bajo la firma de Modus Axon, en el directorio central:
👉 **`modus_axon/technical/models/`**

Ningún agente o desarrollador debe inventar formatos paralelos o estructuras de documentos nuevas. Se debe heredar y adaptar el contenido usando los modelos `00` al `07` allí descritos.

---
*Modus Axon — Bio-Digital Futurism.*

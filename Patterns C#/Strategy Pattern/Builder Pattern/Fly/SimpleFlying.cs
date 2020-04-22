using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Builder_Pattern.Fly
{
    class SimpleFlying : IFly
    {
        public void Fly()
        {
            Console.WriteLine("I'm flying!");
        }
    }
}
